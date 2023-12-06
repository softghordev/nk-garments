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
        Schema::create('employee_personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nid')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_personal_information');
    }
};
