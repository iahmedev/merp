<?php

namespace Database\Seeders;

use App\Models\ApprovalAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['approved', 'rejected', 'forwarded', 'correction'];

        foreach ($actions as $action) {
            ApprovalAction::create(['name' => $action]);
        }
    }
}
