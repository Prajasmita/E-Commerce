<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('product_name');
            $table->string('sku');
            $table->text('short_discription');
            $table->text('long_discription');
            $table->string('price');
            $table->text('special_price');
            $table->date('special_price_from_date');
            $table->date('special_price_to_date');
            $table->string('quantity');
            $table->string('meta_title');
            $table->text('meta_discription');
            $table->string('meta_keyword');
            $table->string('category_id');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
