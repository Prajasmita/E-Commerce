<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('configurations')) {
            Schema::create('configurations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('conf_key',45);
                $table->string('conf_value',100);
                $table->string('created_by',10);
                $table->string('updated_by',10);
                $table->string('status');
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
        Schema::drop('configurations');
    }
}
