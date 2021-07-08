<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class customer extends User
{
    use HasFactory;

    protected $table='customers';
    protected $primaryKey = 'user_id';
    protected $fillable = [];
    protected $hidden = [
        'user_id',
    ];

    public function user_info(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public static function scopeWithUserInfo() {
        return customer::query()
            ->join('users','customers.user_id','=','users.id');
    }

    public function items(){
        return $this->hasMany(item::class,'customer_id');
    }
    public function shipments(){
        return $this->hasMany(shipment::class,'customer_id');
    }


}
