<?php


namespace App\Http\Filters;


use App\Models\in_bound_shipment;

class InBoundShipmentFilter
{
    public static function GetFilteredInBoundShipments($filter,$inBoundShipmentQuery){

        if ($filter->id)
            $inBoundShipmentQuery = self::idQuery($inBoundShipmentQuery,$filter);
        if ($filter->status)
            $inBoundShipmentQuery = self::statusQuery($inBoundShipmentQuery,$filter);
        if ($filter->created_at)
            $inBoundShipmentQuery = self::createdAtQuery($inBoundShipmentQuery,$filter);
        if ($filter->arrival_date)
            $inBoundShipmentQuery = self::arrivalDateQuery($inBoundShipmentQuery,$filter);

        return $inBoundShipmentQuery;
    }
    public static function idQuery($query,$filter){
        return $query->where('shipments.id',$filter->id);
    }
    public static function statusQuery($query,$filter){
        return $query->where('shipments.status',$filter->status);
    }
    public static function createdAtQuery($query,$filter){
        return $query->whereRaw('shipments.created_at = ?',[$filter->created_at]);
    }
    public static function arrivalDateQuery($query,$filter){
        return $query->whereRaw('in_bound_shipments.arrival_date = ?',[$filter->arrival_date]);
    }
}
