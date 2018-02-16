
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
            ['first_name'=>'Prajakta', 'last_name'=>'Sisale','email'=>'prajakta.neosoft@gmail.com'  ,'password' => Hash::make('prajakta123'),'contact_no' => '9821258699',
                'role_id'=>'2'
            ],
            ['first_name'=>'Praju', 'last_name'=>'Sisale','email'=>'prajakta.sisale@neosofttech.com'  ,'password' => Hash::make('praju123'),'contact_no' => '9821258677',
                'role_id'=>'5'
            ]

        ];


        DB::table("users")->insert($usersData);
    }
}

