<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;


class in_bound_shipment extends shipment
{
    use HasFactory;
    protected $table ='in_bound_shipments';
    protected $primaryKey = 'shipment_id';
    public $fillable =['arrival_date','shipment_id'];
    public function shipment_info(){
        return $this->belongsTo(shipment::class,'shipment_id','id');
    }
    public static function scopeWithShipmentInfo() {
        return in_bound_shipment::query()
            ->select('in_bound_shipments.*','shipments.*')
            ->join('shipments','shipment_id','=','shipments.id');
    }
    public function resolveRouteBinding($value, $field = 'shipment_id')
    {
        //return in_bound_shipment::firstOrFail();
        return $this->WithShipmentInfo()->where('shipment_id',$value)->firstOrFail();
    }
    public static function StoreInBoundShipment(Request $request){
        DB::beginTransaction();
        try{
            $shipment = shipment::create([
                'status' => $request->status,
                'customer_id' => auth()->id(),
                'is_in_bound_shipment'=>1
            ]);
            $shipment->in_bound_shipment()->create($request->only(['arrival_date']));
            DB::commit();
            return true;
        }catch (Exception $exception){
            DB::rollBack();
            return $exception;
        }
    }
    public function UpdateInBoundShipment(Request $request){
        DB::beginTransaction();
        try {
            $this->shipment_info()->update([
                'status' => $request->status,
                'is_in_bound_shipment'=>1
            ]);
            $this->update($request->only($this->getFillable()));
            DB::commit();
            return true;
        }catch (Exception $exception){
            DB::rollBack();
            return false;
        }
    }
}
