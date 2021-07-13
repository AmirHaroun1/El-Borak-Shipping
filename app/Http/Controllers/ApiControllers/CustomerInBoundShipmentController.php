<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\inBoundShipmentResource;
use App\Models\in_bound_shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerInBoundShipmentController extends Controller
{

    public function index()
    {

        $InBoundShipments = in_bound_shipment::WithShipmentInfo()
            ->where('shipments.customer_id',auth()->id())
            ->with(['items:id,name,sku,description,grams'])
            ->paginate(10);
        return  inBoundShipmentResource::collection($InBoundShipments);

    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
