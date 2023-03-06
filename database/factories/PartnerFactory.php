<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'fantasy_name' => $this->faker->company(),
            'person_type' => $this->faker->randomElement(['PF','PJ']),
            'document_number' => $this->faker->randomNumber(),
        ];
    }
}
