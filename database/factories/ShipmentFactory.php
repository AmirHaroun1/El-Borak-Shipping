<?php

namespace Database\Factories;

use App\Models\in_bound_shipment;
use App\Models\out_bound_shipment;
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
            'status' => $this->faker->randomElement(['pending',
                'at_warehouse','to_warehouse','to_destination','at_destination']),
            'is_in_bound_shipment' => 1,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (shipment $shipment) {
            switch ($shipment->status){
                case 'pending':
                case 'at_warehouse':
                case 'to_warehouse':
                    $randomInt = $this->faker->randomElement([0,1]);
                    if($randomInt == 0){
                        $shipment->shipment_details()->save(in_bound_shipment::factory()->make());
                    }else{
                        $shipment->shipment_details()->save(out_bound_shipment::factory()->make());
                        $shipment->is_in_bound_shipment = 0;
                        $shipment->save();
                    }
                    break;
                case 'to_destination':
                case 'at_destination':
                    $shipment->shipment_details()->save(out_bound_shipment::factory()->make());
                    $shipment->is_in_bound_shipment = 0;
                    $shipment->save();
                    break;
            }
        });

    }
}
