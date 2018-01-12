<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('company_name')->nullable();
            $table->string('title')->nullable();
            $table->string('email');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->integer('zip_code');
            $table->string('country');
            $table->string('contact_no',10);
            $table->integer('note')->nullable();
            $table->enum('primary',['0','1'])->default('0');
            $table->timestamps();
        });


        Schema::table('user_address', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_address');
    }
}
