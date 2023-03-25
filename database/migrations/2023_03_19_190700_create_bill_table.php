<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->id();
            $table->string('address', 255);
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->string('note', 255)->nullable();
            $table->string('prod_id', 255);
            $table->string('prod_qty', 255);
            $table->text('prod_price');
            $table->string('prod_size', 255);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('bill');
    }
}
