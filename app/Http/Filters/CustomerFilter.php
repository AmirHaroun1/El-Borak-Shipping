<?php


namespace App\Http\filters;



use App\Models\customer;
use App\Models\User;

class CustomerFilter
{

    public static function GetFilteredCustomers($filter,$customerQuery){

        if ($filter->id)
            $customerQuery = self::idQuery($customerQuery,$filter);
        if ($filter->name)
            $customerQuery = self::nameQuery($customerQuery,$filter);
        if ($filter->phone)
            $customerQuery = self::phoneQuery($customerQuery,$filter);
        return $customerQuery;
    }
    public static function idQuery($query,$filter){
        return $query->where('users.id',$filter->id);
    }
    public static function nameQuery($query,$filter){
        return $query->where('users.name','LIKE',$filter->name.'%');
    }
    public static function phoneQuery($query,$filter){
        return $query->where('users.phone',$filter->phone);
    }


}
