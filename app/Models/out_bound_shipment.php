<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class out_bound_shipment extends shipment
{
    use HasFactory;
    protected $primaryKey = 'shipment_id';

    public function shipment_info(){
        return $this->belongsTo(shipment::class,'shipment_id','id');
    }
    public static function scopeWithShipmentInfo() {
        return customer::query()
            ->join('shipments','shipments.id','=','out_bound_shipments.shipment_id');
    }
}
