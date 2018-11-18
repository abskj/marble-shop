<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustColToBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('bills', function($table){
            $table->integer('cust_id')->unsigned();
            $table->foreign('cust_id')->references('id')->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('bills', function($table) {
            $table->dropColumn('cust_id');
        });
    }
}
