<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person_type = $this->faker->randomElement(['PF','PJ']);
        return [
            'company_name' => $this->faker->company(),
            'fantasy_name' => $person_type === 'PJ' ? $this->faker->company() : null,
            'person_type' => $person_type,
            'document_number' => $this->faker->randomNumber(),
        ];
    }
}
