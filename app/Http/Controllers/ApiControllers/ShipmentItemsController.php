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
    }
    public function update(Request $request,shipment $shipment,item $item){
        $shipment->items()->updateExistingPivot($item, [
            'quantity' => $request->quantity,
        ]);
    }
    public function destroy(shipment $shipment,item $item){
        $shipment->items()->detach($item);
    }
}
