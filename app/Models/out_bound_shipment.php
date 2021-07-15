<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class out_bound_shipment extends shipment
{
    protected $table = 'out_bound_shipments';
    use HasFactory;
    protected $primaryKey = 'shipment_id';
    public $fillable=[
        'leaving_date',
        'delivery_arrival_date',
        'delivery_destination',
        'created_at'
    ];
    public function shipment_info(){
        return $this->belongsTo(shipment::class,'shipment_id','id');
    }

    public static function scopeWithShipmentInfo() {
        return out_bound_shipment::query()
            ->select('out_bound_shipments.*','shipments.*')
            ->join('shipments','shipment_id','=','shipments.id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        //return out_bound_shipment::firstOrFail();
        return $this->WithShipmentInfo()->where('shipment_id',$value)->firstOrFail();
    }
    public static function StoreShipment(Request $request){
        DB::beginTransaction();
        try{
            $shipment = shipment::create([
                'status' => $request->status,
                'customer_id' => auth()->id(),
                'is_in_bound_shipment'=> 0
            ]);
            $shipment->out_bound_shipment()->create($request->only(['leaving_date','delivery_arrival_date','delivery_destination']));
            DB::commit();
            return true;
        }catch (QueryException $exception){
            DB::rollBack();
            return $exception;
        }
    }
    public function UpdateShipment(Request $request){
        DB::beginTransaction();
        try {
            $this->shipment_info()->update([
                'status' => $request->status,
                'is_in_bound_shipment'=>0
            ]);
            $this->update($request->only($this->getFillable()));
            DB::commit();
            return true;
        }catch (QueryException $exception){
            DB::rollBack();
            return $exception;
        }
    }
}
