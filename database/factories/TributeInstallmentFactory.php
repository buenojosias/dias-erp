<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TributeInstallment>
 */
class TributeInstallmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => rand(1500, 50000),
            'expiration_date' => $this->faker->dateTimeBetween("-30 days", "+30 dias"),
            'payment_date' => $this->faker->randomElement([null,$this->faker->dateTimeBetween("-30 days", "+30 dias")]),
            'status' => $this->faker->randomElement(['Pendente','Pago','Atrasado']),
        ];
    }
}
