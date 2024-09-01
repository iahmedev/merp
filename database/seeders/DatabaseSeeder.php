<?php

namespace Database\Seeders;

use App\Models\EmploymentInfo;
use App\Models\NextOfKin;
use App\Models\User;
use App\Models\UserDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        $this->call([DesignationSeeder::class, DepartmentSeeder::class, EmploymentStatusSeeder::class, EmploymentTypeSeeder::class]);
        User::all()->each(function ($user) {
            EmploymentInfo::factory()->create(['user_id' => $user->id]);
            UserDetail::factory()->create(['user_id' => $user->id]);
            NextOfKin::factory()->create(['user_id' => $user->id]);
        });
    }
}
