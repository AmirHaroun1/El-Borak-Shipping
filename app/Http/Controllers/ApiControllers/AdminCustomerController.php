<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerInfo;
use App\Http\Resources\CustomerResource;
use App\Models\customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    //
    public function index(){

        $customers = customer::paginate(20);
        return CustomerResource::collection($customers);
    }
    public function store(Request $request){
        $customer = customer::create($request->all());

        return new CustomerResource($customer);
    }
    public function show(customer $customer){
        return new CustomerResource($customer);
    }
    public function update(UpdateCustomerInfo $request,customer $customer){
        $customer =  $customer->updateCustomerUserInfo($request);
        return new CustomerResource($customer);
    }
    public function destroy(customer $customer){

        $customer->user_info()->delete();
        return response()->json($customer,200);
    }
}
