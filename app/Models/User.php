<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'name',
        'national_id',
        'email',
        'password',
        'phone',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getLogoAttribute(){
        if(file_exists(public_path().'/storage/CustomerLogo'.$this->image) && !is_null($this->image))
        {
            return asset('storage/CustomerLogo/'.$this->image);
        }
    }
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }
    public function customer_info(){
        return $this->hasOne(customer::class,'user_id');
    }
    public static function scopeWithCustomersInfo() {
       return User::query()
              ->join('customers','users.id','=','customers.user_id');
    }

}
