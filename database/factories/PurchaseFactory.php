<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
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
            'supplier_id' => rand(1, 10),
            'date' => $this->faker->dateTimeBetween("-60 days", "now"),
            'products' => $this->faker->realTextBetween(10, 30, rand(1, 5)),
            'amount' => rand(100, 150000),
            'payment_method' => $this->faker->randomElement(['À vista', 'Parcelado']),
            'note' => $this->faker->randomElement([null,$this->faker->realText(200, 1)]),
        ];
    }
}
