<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->uuid('id');
            //$table->primary('id');
            //$table->primary(['id','products'])
            $table->unsignedBigInteger('product_type_id');
            $table->string('name');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes(); //for soft deletes
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade')->onUpdate('cascade');
            

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
}
