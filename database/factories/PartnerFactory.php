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
        $person_type = $this->faker->randomElement(['PF','PJ']);
        return [
            'company_name' => $this->faker->company(),
            'fantasy_name' => $person_type === 'PJ' ? $this->faker->company() : null,
            'person_type' => $person_type,
            'document_number' => $person_type === 'PJ' ? rand(00000000, 99999999).'0001'.rand(00, 99) : rand(00000000000, 99999999999),
        ];
    }
}
