<?php

namespace Database\Factories;


use App\Models\out_bound_shipment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class Out_bound_shipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = out_bound_shipment::class;

    public function definition()
    {
        $leavingDate= Carbon::now()->addDays(random_int(0, 565))
            ->addHours(random_int(0,5))
            ->addSeconds(random_int(1,90));
        return [
            'leaving_date'=> $leavingDate,
            'delivery_arrival_date' => $leavingDate->addDays(random_int(7,20)),
            'delivery_destination' => $this->faker->address,
        ];
    }
}
