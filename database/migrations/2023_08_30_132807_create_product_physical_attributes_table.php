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
        Schema::create('product_physical_attributes', function (Blueprint $table) {
            $table->id()->index();;
            $table->unsignedBigInteger('product_id');
            $table->float('weight');
            $table->float('length');
            $table->float('width');
            $table->float('height');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_physical_attributes');
    }
};
