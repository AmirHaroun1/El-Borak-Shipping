<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\in_bound_shipment;
use App\Models\item;
use App\Models\shipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       in_bound_shipment::WithShipmentInfo()->chunk(100,function ($shipments){

           foreach ($shipments as $shipment){
                $items = item::where('customer_id',$shipment->customer_id)->inRandomOrder()->limit(3)->pluck('id');
                $shipment->items()->attach($items,['quantity'=>3]);
           }
        });
    }
}
