<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
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
                $customer->items()->saveMany(item::factory()->count(10)->make());
            }
        });
    }
}
