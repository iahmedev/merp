<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Designation;
use App\Models\EmploymentStatus;
use App\Models\EmploymentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmploymentInfo>
 */
class EmploymentInfoFactory extends Factory
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
            'employee_id' => $this->faker->numerify('######'),
            'department_id' => Department::inRandomOrder()->first()->id,
            'designation_id' => Designation::inRandomOrder()->first()->id,
            'date_of_employment' => $this->faker->date(),
            'date_of_last_promotion' => $this->faker->date(),
            'employment_status_id' => EmploymentStatus::inRandomOrder()->first()->id,
            'employment_type_id' => EmploymentType::inRandomOrder()->first()->id,
        ];
    }
}
