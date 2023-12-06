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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('weight')->nullable();
            $table->string('count')->nullable();
            $table->string('brand')->nullable();
            $table->string('single_dye')->nullable();
            $table->string('double_dye')->nullable();
            $table->string('wash')->nullable();
            $table->string('roll')->nullable();
            $table->string('finished')->nullable();
            $table->string('gsm')->nullable();
            $table->string('source')->nullable();
            $table->string('cone')->nullable();
            $table->string('production_type')->nullable();
            $table->string('csp')->nullable();
            $table->string('twist')->nullable();
            $table->string('image')->nullable();
            $table->string('unit_price');
            $table->string('unit_price_for_salary');
            $table->integer('main_unit_id');
            $table->integer('sub_unit_id')->nullable();
            $table->integer('total_sold')->default(0);
            $table->integer('total_purchase')->default(0);
            // $table->integer('stock')->default(0);
            // $table->integer('main_unit_stock')->default(0);
            // $table->integer('sub_unit_stock')->default(0);
            $table->boolean('show_variation')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
