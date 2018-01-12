<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products',function(Blueprint $table){

            $table->text('special_price')->nullable()->after('price');
            $table->date('special_price_from_date')->nullable()->after('special_price');
            $table->date('special_price_to_date')->nullable()->after('special_price_from_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->dropColumn('special_price');
            $table->dropColumn('special_price_from_date');
            $table->dropColumn('special_price_to_date');

        });
    }
}
