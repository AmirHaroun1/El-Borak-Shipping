<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipment extends Model
{
    use HasFactory;
    protected $table = 'shipments';
    public $fillable = [
        'status' ,
        'is_in_bound_shipment',
        'customer_id'
    ];
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
    public function in_bound_shipment(){
        return $this->hasOne(in_bound_shipment::class,'shipment_id');
    }
    public function out_bound_shipment(){
        return $this->hasOne(in_bound_shipment::class,'shipment_id');
    }

}
