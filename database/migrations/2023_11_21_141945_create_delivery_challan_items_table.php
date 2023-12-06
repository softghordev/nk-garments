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
        Schema::create('delivery_challan_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('delivery_challan_id')->references('id')->on('delivery_challans')->onDelete('cascade');
            $table->foreignId('party_sale_item_id')->references('id')->on('party_sale_items')->onDelete('cascade');
            $table->unsignedInteger('item_id');
            $table->text('details')->nullable();
            $table->integer('main_unit_qty')->nullable();
            $table->integer('sub_unit_qty')->nullable();
            $table->integer('qty');
            $table->unsignedBigInteger('item_variation_id')->nullable();
            $table->integer('total_packages')->nullable();
            $table->text('packaging_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_challan_items');
    }
};
