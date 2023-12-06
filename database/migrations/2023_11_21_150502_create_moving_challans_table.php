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
        Schema::create('moving_challans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->boolean('for_sale')->default(0);
            $table->integer('party_id')->nullable();
            $table->string('showroom')->nullable();
            $table->string('delivery_from')->nullable();
            $table->string('delivery_to')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('release_by')->nullable();
            $table->string('order_by')->nullable();
            $table->string('receive_by')->nullable();
            $table->string('mode_of_transport')->nullable();
            $table->text('transport_details')->nullable();
            $table->text('note')->nullable();
            $table->decimal('payable', 22, 2)->default(0);
            $table->decimal('paid',22,2)->default(0);
            $table->decimal('due',22,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moving_challans');
    }
};
