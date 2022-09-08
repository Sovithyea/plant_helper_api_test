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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->integer('ph')->nullable();
            $table->integer('ec')->nullable();
            $table->integer('temp')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('soil_moisture')->nullable();
            $table->foreignId('crop_id')->unique();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('crop_id')->references('id')->on('crops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measurements');
    }
};
