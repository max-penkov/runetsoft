<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 50);
            $table->string('model');
            $table->integer('width');
            $table->integer('height');
            $table->string('construct', 10);
            $table->integer('diameter');
            $table->string('loadIdx', 10);
            $table->string('speedIdx', 10);
            $table->string('abbr', 10);
            $table->string('runflat', 10);
            $table->string('camera', 10);
            $table->string('season');
            $table->integer('product_id')->references('id')->on('products')->onDelete('CASCADE');
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
        Schema::dropIfExists('attributes');
    }
}
