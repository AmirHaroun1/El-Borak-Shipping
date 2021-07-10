<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCustomerInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $customer = User::firstOrFail('id',$this->route('customer'));

        return [
            'national_id' =>[Rule::unique('users')->ignore($customer),'max:10','min:10'],
            'name' => [ 'string', 'max:255', 'min:3'],
            'phone'=>[Rule::unique('users')->ignore($customer),'min:10','max:10'],
            'email' => [Rule::unique('users'),'email'],

        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors'=>$validator->errors()], 422));
    }
}
