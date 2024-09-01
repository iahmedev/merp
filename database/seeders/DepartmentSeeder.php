<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'human resources'],
            ['name' => 'finance'],
            ['name' => 'security'],
            ['name' => 'sales'],
            ['name' => 'audit'],
            ['name' => 'engineering'],
            ['name' => 'legal'],
            ['name' => 'operations']
        ];

        foreach ($departments as $key => $department) {
            Department::firstOrCreate($department);
        }
    }
}
