<?php

namespace Database\Seeders;

use App\Models\ApprovalRequestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalRequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['pending', 'approved', 'rejected', 'correction'];

        foreach ($statuses as $status) {
            ApprovalRequestStatus::create(['name' => $status]);
        }
    }
}
