<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(2),
            'quantity' => rand(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
            'updated_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }

    public function image_description()
    {
        return $this->state([
            'description' => "<img src='https://source.unsplash.com/random' alt='Image Not Loaded' style='width:400px;height:200px'>"
        ]);
    }

    public function special_name()
    {
        return $this->state([
            'name' => 'created book'
        ]);
    }
}
