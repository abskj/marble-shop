<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('bill_id',15);
            $table->decimal('paid',10,2);
            $table->decimal('due',10,2);
            $table->tinyInteger('settle_mode');
            $table->tinyInteger('status_flag');
            $table->bigInteger('card_number')->nullable();
            $table->string('bank',30)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
