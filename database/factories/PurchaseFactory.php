<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = [
            'Tinta 18 litros',
            'Telhados',
            'Massa acrílica',
            'Impermeabilizante',
            'Massa corrida',
            'Selador',
        ];
        return [
            'service_id' => rand(1, 5),
            'supplier_id' => rand(1, 10),
            'date' => $this->faker->dateTimeBetween("-60 days", "now"),
            'products' => Arr::random($products),
            'amount' => rand(100, 150000),
            'payment_method' => $this->faker->randomElement(['À vista', 'Parcelado']),
            'note' => $this->faker->randomElement([null,$this->faker->realText(200, 1)]),
        ];
    }
}
