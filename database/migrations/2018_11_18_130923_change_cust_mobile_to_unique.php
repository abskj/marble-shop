<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCustMobileToUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('customers', function($table){
            $table->dropColumn('mobile');
            $table->bigInteger('mobile_no')->unique();

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
        Schema::table('customers', function($table) {
            $table->bigInteger('mobile_no')->unique();
            $table->dropColumn('mobile');
        });
    }
}
