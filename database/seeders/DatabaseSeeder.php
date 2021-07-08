<?php

namespace Database\Seeders;

use App\Models\customer;
use App\Models\item;
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
       customer::chunk(100,function ($customers){
            foreach ($customers as $customer){
                $customer->items()->saveMany(item::factory()->count(10)->make());
            }
        });
    }
}
