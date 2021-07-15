<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Filters\OutBoundShipmentFilter;
use App\Http\Resources\outBoundShipmentResource;
use App\Models\out_bound_shipment;
use App\Models\shipment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Mockery\Exception;

class CustomerOutBoundShipmentController extends Controller
{

    public function index()
    {
        $OutBoundShipments = out_bound_shipment::query()
            ->WithShipmentInfo()
            ->when(\request()->hasAny('id','status','arrival_date','created_at'),function($query){
                OutBoundShipmentFilter::GetFilteredOutBoundShipments(\request(),$query);
            })
            ->where('shipments.customer_id',auth()->id())
            ->with(['items:id,name,sku,description,grams'])
            ->paginate(10)
            ->appends(\request()->all());

        return outBoundShipmentResource::collection($OutBoundShipments);
    }

    public function store(Request $request)
    {

        if (out_bound_shipment::StoreShipment($request) instanceof  QueryException){
            return response("Error While Creating Shipment",403);
        }
        return response()->json('Shipment Created Successfully',200);
    }

    public function show(out_bound_shipment $out_bound_shipment)
    {
        return new outBoundShipmentResource($out_bound_shipment);
    }
    public function update(Request $request, out_bound_shipment $out_bound_shipment)
    {
        if($out_bound_shipment->UpdateShipment($request) instanceof QueryException){
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
