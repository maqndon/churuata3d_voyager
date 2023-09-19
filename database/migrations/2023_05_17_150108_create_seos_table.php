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
        Schema::create('seos', function (Blueprint $table) {
            $table->id()->index();
            $table->string('seoable_type');
            $table->unsignedBigInteger('seoable_id');
            $table->string('title');
            $table->string('meta_description');
            $table->timestamps();

            // Indexes
            $table->index(['seoable_type', 'seoable_id']);
            $table->foreign('seoable_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seos');
    }
};
