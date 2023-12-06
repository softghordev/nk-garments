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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->integer('bank_account_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->enum('payment_type', ['receive', 'pay']);
            $table->unsignedInteger('paymentable_id');
            $table->string('paymentable_type');
            $table->string('source_of_payment')->nullable();
            $table->decimal('amount',22,2 )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
