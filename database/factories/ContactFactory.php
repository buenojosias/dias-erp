<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'representative' => $this->faker->name(),
            'phone' => $this->faker->randomElement([null, $this->faker->phoneNumber()]),
            'whatsapp' => $this->faker->randomElement([null, $this->faker->phoneNumber()]),
            'email' => $this->faker->randomElement([null, $this->faker->email()]),
        ];
    }
}
