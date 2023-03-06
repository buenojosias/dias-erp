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
            'client_id' => rand(1, 10),
            'contract_number' => rand(100,999),
            'start_date' => $this->faker->dateTimeBetween("-60 days", "now"),
            'end_date' => $this->faker->dateTimeBetween("now", "+60 days"),
            'amount' => rand(100000, 4000000),
            'installments' => rand(1, 12),
            'status' => $this->faker->randomElement(['Aguardando','Em execução','Interrompida','Concluída','Atrasada']),
            'note' => $this->faker->randomElement([null,$this->faker->realText(200, 1)]),
        ];
    }
}
