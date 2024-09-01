<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            [ 'name' => 'CEO'],
            [ 'name' => 'Executive Director'],
            [ 'name' => 'Director'],
            [ 'name' => 'Manager'],
            [ 'name' => 'Chief Officer'],
            [ 'name' => 'Senior Officer'],
            [ 'name' => 'Junior Officer'],
        ];

        foreach ($designations as $key => $designation) {
            Designation::firstOrCreate($designation);
        }
    }
}
