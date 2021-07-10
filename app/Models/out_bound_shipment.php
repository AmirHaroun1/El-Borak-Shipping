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
        return out_bound_shipment::query()
            ->join('shipments','shipment_id','=','shipments.id');
    }
}
