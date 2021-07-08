<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class customer extends User
{
    use HasFactory;

    protected $table='customers';
    protected $primaryKey = 'user_id';


    public function user_info(){
        return $this->belongsTo(User::class,'user_id','id');
    }



}
