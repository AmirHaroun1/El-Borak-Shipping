<?php

namespace Database\Factories;

use App\Models\customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'business_description'=>$this->faker->paragraph(8),
            'logo'=>null,
            'address' => $this->faker->address,
            'type' => $this->faker->randomElement(['Basic','Gold','Platinum'])
        ];
    }
}
