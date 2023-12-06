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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('party_type')->nullable();
            $table->string('party_name');
            $table->string('company_name')->nullable();
            $table->string('owner_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('email')->nullable();
            $table->text('web_page')->nullable();
            $table->string('business_phone')->nullable();       
            $table->string('home_phone')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('party_bank_details')->nullable();
            $table->string('image')->nullable();
            $table->date('registration_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
