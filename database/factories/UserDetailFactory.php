<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
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
            'phone' => $this->faker->numerify('###########'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->streetAddress(),
            'marital_status' => $this->faker->randomElement(['single', 'married', 'widowed']),
            'state' => $this->faker->state(),
            'lga' => $this->faker->city(),
            'date_of_birth' => $this->faker->date(),
            'nin' => $this->faker->numerify('###########'),
        ];
    }
}
