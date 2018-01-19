<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('payment_gateway_id');
            $table->float('grand_total')->nullable();
            $table->float('shipping_charges')->nullable();
            $table->float('discount')->nullable();
            $table->text('transaction_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->enum('status',['P','O','S','D'])->nullable();
            $table->timestamps();
        });

        Schema::table('user_order', function($table) {
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
        Schema::drop('user_order');

    }
}
