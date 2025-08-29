<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date('Y-m-d', '2000-01-01'), // Fødselsdato før 2000
            'death_date' => null, // Eller: $this->faker->optional()->date('Y-m-d', '2025-01-01'),
            'description' => $this->faker->text(200),
        ];
    }
}
