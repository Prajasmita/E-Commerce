<?php

use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
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

        Payment_gateway::truncate();
        $paymentgateways = [
            ['name'=>'COD'],
            ['name'=>'CashOnDelivery'],

        ];

        DB::table("roles")->insert($paymentgateways);
    }
}
