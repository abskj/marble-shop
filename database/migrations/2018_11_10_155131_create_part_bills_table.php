<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('bill_id',15);
            $table->integer('product_id')->unsigned();
            $table->decimal('quantity',10,2);
            $table->decimal('price',10,2);
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('product_id')->references('id')->on('products');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_bills');
    }
}
