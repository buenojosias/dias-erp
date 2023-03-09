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
        $status = $this->faker->randomElement(['Pendente','Pago','Atrasado']);
        return [
            'expiration_date' => $this->faker->dateTimeBetween("-30 days", "+30 dias"),
            'payment_date' => $status === 'Pago' ? $this->faker->dateTimeBetween("-30 days", "+30 dias") : null,
            'status' => $status,
        ];
    }
}
