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
            $table->increments('id');
            $table->timestamps();
            $table->string('name',200);
            $table->decimal('price',10,2);
            $table->decimal('quantity',10,2);
            $table->integer('company')->unsigned();
            $table->integer('type')->unsigned();
            $table->string('img_url',200);
            $table->foreign('company')->references('id')->on('companies');
            $table->foreign('type')->references('id')->on('categories');
            $table->string('prop1',200);
            $table->string('prop2',200);
            $table->string('prop3',200);
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
