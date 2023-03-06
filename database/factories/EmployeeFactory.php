<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->randomNumber(),
            'rg' => $this->faker->randomNumber(),
            'birthday' => $this->faker->date($format = "Y-m-d", $max = "now"),
            'role' => $this->faker->randomElement(['Pintor','Pedreiro']),
        ];
    }
}
