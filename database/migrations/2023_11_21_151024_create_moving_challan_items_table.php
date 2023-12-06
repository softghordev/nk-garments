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
        Schema::create('moving_challan_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreignId('moving_challan_id')->references('id')->on('moving_challans')->onDelete('cascade');
            $table->unsignedInteger('item_id');
            $table->text('details')->nullable();
            $table->integer('main_unit_qty')->nullable();
            $table->integer('sub_unit_qty')->nullable();
            $table->integer('qty');
            $table->integer('total_packages')->nullable();
            $table->text('packaging_details')->nullable();
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
        Schema::dropIfExists('moving_challan_items');
    }
};
