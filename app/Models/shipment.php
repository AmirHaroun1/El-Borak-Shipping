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
    public function documents(){
        return $this->hasMany(document::class,'shipment_id');
    }
    public function items(){
        return $this->belongsToMany(item::class, 'item_shipment', 'shipment_id', 'item_id')->withPivot('quantity');
    }
}
