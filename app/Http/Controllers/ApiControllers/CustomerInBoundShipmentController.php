<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Filters\InBoundShipmentFilter;
use App\Http\Resources\inBoundShipmentResource;
use App\Models\in_bound_shipment;
use App\Models\shipment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CustomerInBoundShipmentController extends Controller
{

    public function index()
    {

        $InBoundShipments = in_bound_shipment::query()
            ->WithShipmentInfo()
            ->when(\request()->hasAny('id','status','arrival_date','created_at'),function($query){
                InBoundShipmentFilter::GetFilteredInBoundShipments(\request(),$query);
            })
            ->where('shipments.customer_id',auth()->id())
            ->with(['items:id,name,sku,description,grams'])
            ->paginate(10)
            ->appends(\request()->all());

        return inBoundShipmentResource::collection($InBoundShipments);
    }
    public function store(Request $request)
    {
        if (in_bound_shipment::StoreShipment($request) instanceof QueryException){
            return response('Error While Creating Shipment',400);
        }
        return response()->json('Shipment Created Successfully',200);
    }
    public function show(in_bound_shipment $in_bound_shipment)
    {
        return new inBoundShipmentResource($in_bound_shipment);
    }
    public function update(Request $request, in_bound_shipment $in_bound_shipment)
    {
        if($in_bound_shipment->UpdateShipment($request) instanceof QueryException){
            return response('Error While Updating Shipment',400);
        }
        return response()->json('Shipment Updated Successfully',200);
    }
    public function destroy($id)
    {
        shipment::destroy($id);
        return response()->json('',200);
    }
}
