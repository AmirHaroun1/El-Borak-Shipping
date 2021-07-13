<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->user_info->id,
            'national_id' => $this->user_info->national_id,
            'name' => $this->user_info->name,
            'email' => $this->user_info->email,
            'password' => $this->user_info->password,
            'phone' => $this->user_info->phone,
            'logo' => $this->logo,
            'address' => $this->address,
            'type' => $this->type,
            'business_description' => $this->business_description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
