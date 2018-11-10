<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->timestamps();
            $table->string('user_name',15)->unique();
            $table->string('password',200);
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->tinyInteger('type');
            $table->primary('user_name');
            $table->string('prop1')->nullable();
            $table->string('prop2')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
