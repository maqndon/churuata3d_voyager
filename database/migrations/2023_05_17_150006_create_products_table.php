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
            $table->string('stock');
            $table->float('price');
            $table->string('seo_title');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->string('product_image')->nullable();
            $table->json('product_gallery')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');
            $table->boolean('featured')->default(0);
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
