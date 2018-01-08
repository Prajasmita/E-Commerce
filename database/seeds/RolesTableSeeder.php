<?php

use Illuminate\Database\Seeder;
use App\Role;
Use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Role::truncate();
        $roleNames = [
            ['name'=>'Superadmin'],
            ['name'=>'Admin'],
            ['name'=>'Inventory Manager'],
            ['name'=>'Order Manager'],
            ['name'=>'Customer']
        ];

        DB::table("roles")->insert($roleNames);
    }
}
