<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        customer::chunk(100,function ($customers){
            foreach ($customers as $customer){
                $customer->shipments()->saveMany(shipment::factory()->count(30)->make());
            }
        });
    }
}
