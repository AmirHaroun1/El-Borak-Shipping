<?php

namespace App\Http\Controllers;

use App\Models\shipment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OutBoundShipmentController extends Controller
{
    //
    use HasFactory;
    protected $primaryKey = 'shipment_id';

    public function shipment_info(){
        return $this->belongsTo(shipment::class,'shipment_id','id');
    }
}
