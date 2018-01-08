<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('first_name', 30);
                $table->string('last_name', 30);
                $table->string('email')->unique();
                $table->string('contact_no',10);
                $table->string('password', 60);
                $table->integer('role_id');
                $table->enum('status',['0','1'])->default('1');
                $table->rememberToken();
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
