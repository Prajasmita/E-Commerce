<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            ['first_name'=>'admin', 'last_name'=>'admin','email'=>'admin@gmail.com'  ,'password' => Hash::make('admin123'),
                'role_id'=>'2'
            ],
            ['first_name'=>'qqq', 'last_name'=>'qqq','email'=>'qqq@gmail.com'  ,'password' => Hash::make('qqq111qqq'),
                'role_id'=>'1'
            ]

        ];


        DB::table("users")->insert($usersData);
    }
}

