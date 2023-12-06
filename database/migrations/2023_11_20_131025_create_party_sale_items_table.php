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
        Schema::create('party_sale_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('party_sale_id')->references('id')->on('party_sales')->onDelete('cascade');
            $table->unsignedInteger('item_id');
            $table->text('details')->nullable();
            $table->integer('main_unit_qty')->nullable();
            $table->integer('sub_unit_qty')->nullable();
            $table->integer('qty');
            $table->integer('due_main_unit_qty')->nullable();
            $table->integer('due_sub_unit_qty')->nullable();
            $table->integer('due_qty')->nullable();
            $table->unsignedBigInteger('item_variation_id')->nullable();
            $table->decimal('commission',10,2)->nullable();
            $table->decimal('rate',10,2);
            $table->decimal('sub_total',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('party_sale_items');
    }
};
