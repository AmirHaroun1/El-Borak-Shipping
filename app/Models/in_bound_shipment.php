<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class in_bound_shipment extends shipment
{
    use HasFactory;
    protected $primaryKey = 'shipment_id';

    public function shipment_info(){
        return $this->belongsTo(shipment::class,'shipment_id','id');
    }
}
