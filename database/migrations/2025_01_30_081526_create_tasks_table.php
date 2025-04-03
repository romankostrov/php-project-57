<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TaskStatus;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->text('description')->nullable();
            $table->foreignIdFor(TaskStatus::class, 'status_id')->constrained('task_statuses');
            $table->foreignIdFor(User::class, 'created_by_id')->constrained('users');
            $table->foreignIdFor(User::class, 'assigned_to_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
