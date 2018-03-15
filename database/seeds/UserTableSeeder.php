
<?php

use Illuminate\Database\Seeder;
Use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
            ['first_name'=>'Admin', 'last_name'=>'Admin','email'=>'admin@gmail.com'  ,'password' => Hash::make('admin123'),'contact_no' => '9821258699',
                'role_id'=>'2','created_at' => Carbon::now(),

            ],
            ['first_name'=>'Prajakta', 'last_name'=>'Sisale','email'=>'prajakta.neosoft@gmail.com'  ,'password' => Hash::make('prajakta123'),'contact_no' => '9821258699',
                'role_id'=>'2','created_at' => Carbon::now(),

            ],
            ['first_name'=>'Praju', 'last_name'=>'Sisale','email'=>'prajakta.sisale@neosofttech.com'  ,'password' => Hash::make('praju123'),'contact_no' => '9821258677',
                'role_id'=>'5','created_at' => Carbon::now(),
            ]

        ];


        DB::table("users")->insert($usersData);
    }
}

