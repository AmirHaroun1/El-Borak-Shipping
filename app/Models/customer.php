<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class customer extends User
{
    use HasFactory;

    protected $table='customers';
    protected $primaryKey = 'user_id';
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


}
