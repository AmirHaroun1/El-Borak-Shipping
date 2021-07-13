<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(customer::class,'customer_id','user_id');
    }
    public function shipments(){
        return $this->belongsToMany(item::class, 'item_shipment', 'item_id', 'shipment_id');
    }
}
