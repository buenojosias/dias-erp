<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street_name' => $this->faker->streetName(),
            'number' => rand(10, 9999),
            'complement' => $this->faker->randomElement([null, $this->faker->secondaryAddress()]),
            'district' => $this->faker->cityPrefix(),
            'zip_code' => rand(80000, 82999). '-' .rand(010, 999),
            'city' => $this->faker->city(),
            'state' => 'PR',
        ];
    }
}
