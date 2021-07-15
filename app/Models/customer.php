<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class customer extends User
{
    use HasFactory;

    protected $table='customers';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'business_description',
        'logo',
        'address',
        'type'
    ];
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
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->WithUserInfo()->findOrFail($value);
    }
    public function items(){
        return $this->hasMany(item::class,'customer_id');
    }
    public function shipments(){
        return $this->hasMany(shipment::class,'customer_id');
    }
    public static function createCustomerUser(Request $request){
        DB::beginTransaction();
        try{
            $UserAttrs = $request->only((new User)->getFillable());
            $user = User::create($UserAttrs);
            $user->customer_info()->create($request->except($UserAttrs));
            DB::commit();
            return true;
        }catch (Exception $exception){
            DB::rollBack();
            return false;
        }
    }
    public function updateCustomerUserInfo(Request $request){
        DB::beginTransaction();
        try{
           $this->user_info()->update(
               $request->except($this->getFillable())
           );
           if ($request->file('logo')){
               $request['logo'] =  $this->saveLogo($request);
           }
           $this->update(
               $request->only($this->getFillable())
           );
           DB::commit();
           return true;
       }catch (Exception $exception){
            DB::rollBack();
            return false;
        }
    }
    public function saveLogo(Request $request){
        if (!is_null($this->logo))
            unlink('storage/CustomerLogo/'.$this->logo);
        $path = $request->file('logo')->store('CustomerLogo');;
        return $path;
    }

}
