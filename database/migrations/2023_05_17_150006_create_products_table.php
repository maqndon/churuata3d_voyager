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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title');
            $table->string('slug')->unique();;
            $table->string('sku')->unique();;
            $table->text('excerpt');
            $table->text('body');
            $table->integer('stock')->nullable();
            $table->float('price')->nullable();
            $table->float('sale_price')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('files')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');
            $table->string('featured')->nullable();
            $table->boolean('virtual')->default(1);
            $table->boolean('downloadable')->default(1);
            $table->boolean('printable')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
