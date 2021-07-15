<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\item;
use App\Models\shipment;
use Illuminate\Http\Request;

class ShipmentItemsController extends Controller
{
    public function store(Request $request,shipment $shipment,item $item){
        $shipment->items()->attach($item,['quantity'=>$request->quantity]);
        return response()->json('Item Added To Shipment Successfully',200);
    }
    public function update(Request $request,shipment $shipment,item $item){
        $shipment->items()->updateExistingPivot($item, [
            'quantity' => $request->quantity,
        ]);
        return response()->json('Item in Shipment updated Successfully',200);
    }
    public function destroy(shipment $shipment,item $item){
        $shipment->items()->detach($item);
        return response()->json('Item Deleted From Shipment Successfully',200);
    }
}
