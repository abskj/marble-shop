<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->string('id',15);
            $table->timestamps();
            $table->decimal('total',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('final',10,2);
            $table->decimal('amount_paid',10,2);
            $table->decimal('amount_due',10,2);
            $table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
