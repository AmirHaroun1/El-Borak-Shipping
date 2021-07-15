<?php


namespace App\Http\Filters;


class OutBoundShipmentFilter
{

    public static function GetFilteredOutBoundShipments($filter,$OutBoundShipmentQuery){
        if ($filter->id)
            $OutBoundShipmentQuery = self::idQuery($OutBoundShipmentQuery,$filter);
        if ($filter->status)
            $OutBoundShipmentQuery = self::statusQuery($OutBoundShipmentQuery,$filter);
        if ($filter->created_at)
            $OutBoundShipmentQuery = self::createdAtQuery($OutBoundShipmentQuery,$filter);
        if ($filter->delivery_arrival_date)
            $OutBoundShipmentQuery = self::deliveryArrivalDateQuery($OutBoundShipmentQuery,$filter);
        if ($filter->leaving_date)
            $OutBoundShipmentQuery = self::leavingDateQuery($OutBoundShipmentQuery,$filter);
        if ($filter->delivery_destination)
            $OutBoundShipmentQuery = self::deliveryDestinationQuery($OutBoundShipmentQuery,$filter);

        return $OutBoundShipmentQuery;
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
    public static function deliveryArrivalDateQuery($query,$filter){
        return $query->whereRaw('out_bound_shipments.delivery_arrival_date = ?',[$filter->delivery_arrival_date]);
    }
    public static function leavingDateQuery($query,$filter){
        return $query->whereRaw('out_bound_shipments.leaving_date = ?',[$filter->leaving_date]);
    }
    public static function deliveryDestinationQuery($query,$filter){
        return $query->whereRaw('out_bound_shipments.leaving_date LIKE ?',[$filter->delivery_destination]);
    }
}
