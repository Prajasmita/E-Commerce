<?php

use Illuminate\Database\Seeder;

class roles_Table_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
