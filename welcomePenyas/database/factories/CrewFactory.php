<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crew>
 */
class CrewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'logo' => 'placeholder',
            'capacity_people' => 666,
            'slogan' => fake()->sentence(),
            'color' => fake()->colorName(),
            'foundation_date' => fake()->date('Y-m-d', 'now')
        ];
    }
}
