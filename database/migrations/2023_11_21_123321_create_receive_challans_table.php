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
        Schema::create('receive_challans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->integer('party_id')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('receive_by')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('order_by');
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
        Schema::dropIfExists('receive_challans');
    }
};
