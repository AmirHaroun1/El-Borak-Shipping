<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class shipment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function getIsInBoundShipmentAttribute(){
        if ($this->attributes['is_in_bound_shipment'] == 1){
            return true;
        }
            return false;

    }
    public function shipment_details(){
        if ($this->is_in_bound_shipment){
            return $this->hasOne(in_bound_shipment::class,'shipment_id');
        }
        return $this->hasOne(out_bound_shipment::class,'shipment_id');
    }
    public function documents(){
        return $this->hasMany(document::class,'shipment_id');
    }
}
