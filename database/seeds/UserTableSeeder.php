
<?php

use Illuminate\Database\Seeder;
Use App\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
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

        User::truncate();
        $usersData = [
            ['first_name'=>'admin', 'last_name'=>'admin','email'=>'admin@gmail.com'  ,'password' => Hash::make('admin123'),'contact_no' => '9821258699',
                'role_id'=>'2'
            ],
            ['first_name'=>'Asmita', 'last_name'=>'Sisale','email'=>'asmita.sisale@gmail.com'  ,'password' => Hash::make('aaaaaaaaa'),'contact_no' => '9821258677',
                'role_id'=>'5'
            ]

        ];


        DB::table("users")->insert($usersData);
    }
}

