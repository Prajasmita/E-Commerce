<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyInRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('role_user', 'role_id') && Schema::hasColumn('role_user', 'user_id')) {
            Schema::table('role_user', function (Blueprint $table) {
                $table->dropColumn('role_id');
                $table->dropColumn('user_id');
            });
        }
            Schema::table('role_user', function ($table) {
                $table->integer('role_id')->after('id')->foreign()->references("id")->on("users")->onDelete("cascade");
                $table->integer('user_id')->after('role_id')->foreign()->references("id")->on("users")->onDelete("cascade");
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('role_user', 'role_id') && Schema::hasColumn('role_user', 'user_id'))
        {
            Schema::table('role_user', function (Blueprint $table)
            {
                $table->dropColumn('role_id');
                $table->dropColumn('user_id');
            });
        }
    }
}
