<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name_product', 255);
            $table->text('description')->nullable(true);
            $table->text('info')->nullable(true);
            $table->string('short_description', 255)->nullable(true);
            $table->string('size', 255)->nullable(true);
            $table->integer('old_price');
            $table->integer('new_price')->default(0);
            $table->string('thumb', 255);
            $table->string('image1', 255)->nullable();
            $table->string('image2', 255)->nullable();
            $table->string('image3', 255)->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('category_id');
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
        Schema::dropIfExists('product');
    }
}
