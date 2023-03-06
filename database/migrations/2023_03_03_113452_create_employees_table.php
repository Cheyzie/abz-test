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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignId('position_id')->constrained('positions')->cascadeOnDelete();
            $table->date('hire_date');
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->decimal('salary', 6, 3);
            $table->string('photo')->nullable();
            $table->foreignId('head_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('admin_created_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('admin_updated_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
