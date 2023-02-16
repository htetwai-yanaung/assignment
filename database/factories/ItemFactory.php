<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $num = 1;
        return [
            'name' => fake()->name(),
            'category_id' => rand(1, 5),
            'price' => rand(1000, 10000),
            'description' => fake()->text(),
            'condition_id' => rand(1, 2),
            'type_id' => rand(1, 3),
            'status' => fake()->randomElement($array = array ('publish','unpublish')),
            'photo' => 'default.png',
            'owner_id' => $num++,
        ];
    }
}
