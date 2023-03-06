<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposal>
 */
class ProposalFactory extends Factory
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
            'date' => $this->faker->dateTimeBetween("-20 days", "now"),
            'amount' => rand(100000, 4000000),
            'status' => $this->faker->randomElement(['Aguardando','Em negociação','Aceito','Recusado']),
            'note' => $this->faker->randomElement([null,$this->faker->realText(200, 1)]),
        ];
    }
}
