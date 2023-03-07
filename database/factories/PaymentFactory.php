<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => rand(1, 5),
            'date' => $this->faker->dateTimeBetween("-60 days", "now"),
            'amount' => rand(10000, 500000),
            'note' => $this->faker->randomElement([null,$this->faker->realText(200, 1)]),
        ];
    }
}
