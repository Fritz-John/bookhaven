<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), 
            'description' => $this->faker->paragraph, 
            'author' => $this->faker->name, 
            'categories_id' => $this->faker->numberBetween(1, 8), 
            'price' => $this->faker->randomFloat(2, 5, 100), 
            'stock_quantity' => $this->faker->numberBetween(1, 100),  
            'featured' =>  $this->faker->boolean(),
        ];
    }
}
