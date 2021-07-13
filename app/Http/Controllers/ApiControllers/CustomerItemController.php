<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\itemResource;

use App\Models\customer;
use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerItemController extends Controller
{

    public function index()
    {
        $items = item::where('customer_id',Auth::id())->get();

        return itemResource::collection($items);
    }

    public function store(Request $request)
    {

        $item = customer::firstOrFail('user_id',Auth::id())->items()->create($request->all());

        return new itemResource($item);
    }

    public function show(item $item)
    {
        if ($item->customer_id != Auth::id()){
            return response()->json('You cant do that',403);
        }
        return new itemResource($item);
    }

    public function update(Request $request,item $item)
    {
        if ($item->customer_id != Auth::id()){
            return response()->json('You cant do that',403);
        }
        $item->update($request->all());

        return new itemResource($item);
    }
    public function destroy(item $item)
    {
        if ($item->customer_id != Auth::id()){
            return response()->json('You cant do that',403);
        }
        $item->delete();
        return response()->json($item,200);
    }
}
