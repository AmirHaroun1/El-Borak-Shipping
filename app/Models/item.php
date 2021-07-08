<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function customer(){
        return $this->belongsTo(customer::class,'customer_id','user_id');
    }
}
