<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  \App\Models\User::factory(),
            'service_id' =>  \App\Models\Service::factory(),
            'time' => $this->faker->time(),
            'date' => $this->faker->dateTimeThisYear(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'payment_type' => $this->faker->randomElement(['deposit', 'full_price']),
        ];
    }
}
