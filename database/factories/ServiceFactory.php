<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->time(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'type' => $this->faker->randomElement(['women', 'men', 'kids', 'any']),
            'deposit_price' => $this->faker->randomFloat(2, 10, 30),
            'service_category_id' => \App\Models\ServiceCategory::factory(),
        ];
    }
}
