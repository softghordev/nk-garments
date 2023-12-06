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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->decimal('basic_salary')->default(0);
            $table->decimal('house_rent')->nullable();
            $table->decimal('medical_allowance')->nullable();
            $table->decimal('child_allowance')->nullable();
            $table->decimal('communication_allowance')->nullable();
            $table->decimal('special_allowance')->nullable();
            $table->decimal('lta')->nullable();
            $table->decimal('bonus')->nullable();
            $table->decimal('total_salary')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
