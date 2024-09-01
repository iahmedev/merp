<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NextOfKin>
 */
class NextOfKinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->firstName().' '.$this->faker->lastName(),
            'email' => fake()->unique()->email(),
            'phone' => $this->faker->numerify('###########'),
            'address' => $this->faker->streetAddress(),
            'relationship' => $this->faker->randomElement(['husband', 'wife', 'son',
                'daughter', 'brother', 'sister', 'father', 'mother']),
        ];
    }
}
