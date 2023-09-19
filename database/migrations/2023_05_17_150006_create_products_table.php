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
            $table->unsignedBigInteger('created_by');
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
            $table->boolean('virtual')->default(true);
            $table->boolean('downloadable')->default(true);
            $table->boolean('printable')->default(true);
            $table->boolean('is_parametric')->default(false);
            $table->string('related_parametric')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
