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
            $table->text('short_discription')->nullable();
            $table->text('long_discription')->nullable();
            $table->string('price')->nullable();
            /*$table->text('special_price')->nullable();
            $table->date('special_price_from_date')->nullable();
            $table->date('special_price_to_date');*/
            $table->string('quantity');
            $table->string('meta_title')->nullable();
            $table->text('meta_discription')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('category_id')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->enum('is_feature',['0','1'])->default('1');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
