<?php

namespace Database\Factories;

use App\Models\item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Silver Necklace','Polo T-shirt','Vase','Shampoo','Bracelets','Mobile','Plastic']),
            'sku'=> $this->faker->randomKey() . $this->faker->randomDigit(),
            'description' => $this->faker->paragraph(1),
            'grams' => $this->faker->numberBetween(4,10000),
        ];
    }
}
