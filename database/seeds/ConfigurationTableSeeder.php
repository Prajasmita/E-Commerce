<?php

use Illuminate\Database\Seeder;
use App\Configuration;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        Configuration::truncate();
        $configurationData = [
            ['conf_key'=>'Admin_email', 'conf_value'=>'prajakta.neosoft@gmail.com','	status'=>'1'  ,'created_by' => '','updated_by' => '',
                'created_at' => Carbon::now(),
            ],
            ['conf_key'=>'support_contact', 'conf_value'=>'(+91) 989 858 4545','	status'=>'1'  ,'created_by' => '','updated_by' => '',
                'created_at' => Carbon::now(),
            ],
            ['conf_key'=>'support_email', 'conf_value'=>'ecommerce.prajakta@eshopper.com','	status'=>'1'  ,'created_by' => '','updated_by' => '',
                'created_at' => Carbon::now(),
            ],
            ['conf_key'=>'InventoryManager_email', 'conf_value'=>'Sanjaykumar.sisale123@gmail.com','	status'=>'0'  ,'created_by' => '','updated_by' => '',
                'created_at' => Carbon::now(),
            ],
        ];


        DB::table("configuration")->insert($configurationData);
    }
}
