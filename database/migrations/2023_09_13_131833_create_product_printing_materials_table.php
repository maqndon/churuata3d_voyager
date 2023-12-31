<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_printing_materials', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('printing_material_id');
            $table->unique(['product_id', 'printing_material_id'], 'unique_product_material');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('printing_material_id')->references('id')->on('printing_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_printing_materials');
    }
};
