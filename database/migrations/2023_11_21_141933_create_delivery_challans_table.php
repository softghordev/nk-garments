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
        Schema::create('delivery_challans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('party_sale_id')->references('id')->on('party_sales')->onDelete('cascade');
            $table->string('showroom')->nullable();
            $table->date('sale_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->text('delivery_address')->nullable();
            $table->string('order_by')->nullable();
            $table->string('dispatched_by')->nullable();
            $table->string('mode_of_transport')->nullable();
            $table->text('transport_details')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_challans');
    }
};
