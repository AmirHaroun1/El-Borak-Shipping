<?php

namespace Database\Factories;

use App\Models\in_bound_shipment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class In_bound_shipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = in_bound_shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'arrival_date'=> Carbon::now()->addDays(rand(0, 565))
                ->addHours(rand(0,5))
                ->addSeconds(rand(1,90)),
        ];
    }
}
