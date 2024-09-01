<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_request_id')->constrained('approval_requests')->onDelete('cascade'); // Foreign key
            $table->foreignId('approver_id')->constrained('users'); // Foreign key to users
            $table->foreignId('approval_action_id')->constrained('approval_actions'); // Foreign key
            $table->foreignId('forwarded_to_id')->nullable()->constrained('users'); // Optional forwarding
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
