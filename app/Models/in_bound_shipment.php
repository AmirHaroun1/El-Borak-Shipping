<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class in_bound_shipment extends shipment
{
    use HasFactory;
    protected $primaryKey = 'shipment_id';
    protected $hidden = ['shipment_id','customer_id'];
    public function shipment_info(){
        return $this->belongsTo(shipment::class,'shipment_id','id');
    }

    public static function scopeWithShipmentInfo() {
        return in_bound_shipment::query()
            ->select('in_bound_shipments.*','shipments.*')
            ->join('shipments','shipment_id','=','shipments.id');
    }

}
