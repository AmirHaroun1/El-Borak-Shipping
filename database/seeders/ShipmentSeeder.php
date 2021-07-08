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
                shipment::factory()->state(['customer_id'=>$customer->user_id])->count(30)->create();
            }
        });
    }
}
