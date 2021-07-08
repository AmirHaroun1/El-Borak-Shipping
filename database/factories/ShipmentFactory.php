<?php

namespace Database\Factories;

use App\Models\shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(['pending','at_warehouse','to_warehouse','to_destination','at_destination']),
            'is_in_bound_shipment' => 1,
        ];
    }
    public function configure()
    {
        return $this->afterMaking(function (shipment $shipment) {

        });

    }
}
