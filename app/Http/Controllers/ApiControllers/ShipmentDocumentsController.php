<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\documentResource;
use App\Models\document;
use Illuminate\Http\Request;

class ShipmentDocumentsController extends Controller
{
    public function index($shipment_id){
        $documents = document::where('shipment_id',$shipment_id)->get();
        return documentResource::collection($documents);
    }

}
