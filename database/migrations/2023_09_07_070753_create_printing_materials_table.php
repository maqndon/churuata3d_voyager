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
        Schema::create('printing_materials', function (Blueprint $table) {
            $table->id()->index();;
            $table->string('name');
            $table->decimal('nozzle_size')->default(0.4);
            $table->tinyInteger('min_hot_bed_temp')->unsigned();
            $table->tinyInteger('max_hot_bed_temp')->unsigned();
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
        Schema::dropIfExists('printing_materials');
    }
};
