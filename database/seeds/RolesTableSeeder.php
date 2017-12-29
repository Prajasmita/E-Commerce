<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleNames = [
            ['role_name'=>'Superadmin'],
            ['role_name'=>'Admin'],
            ['role_name'=>'Inventory Manager'],
            ['role_name'=>'Order Manager'],
            ['role_name'=>'Customer']
        ];

        DB::table("roles")->insert($roleNames);
    }
}
