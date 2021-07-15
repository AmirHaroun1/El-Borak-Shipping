<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;

use App\Http\filters\CustomerFilter;
use App\Http\Requests\UpdateCustomerInfo;
use App\Http\Resources\CustomerResource;

use App\Models\customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    //
    public function index(){

        $customers = customer::WithUserInfo()
        ->when(\request()->hasAny('id','name','phone'),function($query){
            CustomerFilter::GetFilteredCustomers(\request(),$query);
        })->paginate(20)
          ->appends(\request()->all());

        return CustomerResource::collection($customers);
    }
    public function store(Request $request){
        $customer = customer::createCustomerUser($request);
        if (!$customer){
            return response('Error While Creating Customer',400);
        }
        return response()->json('Customer Created Successfully',200);
    }
    public function show(customer $customer){
        return new CustomerResource($customer);
    }
    public function update(UpdateCustomerInfo $request,customer $customer){
        if (!$customer->updateCustomerUserInfo($request)){
            return response('Error While Updating Customer',400);
        }
        return response()->json('Customer Updated Successfully',200);
    }
    public function destroy(customer $customer){
        $customer->user_info()->delete();
        return response()->json($customer,200);
    }
}
