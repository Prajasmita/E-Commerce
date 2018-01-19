<?php

use Illuminate\Database\Seeder;
Use App\Payment_gateway;

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
            ['id'=>'1','name'=>'COD'],
            ['id'=>'2','name'=>'CashOnDelivery'],

        ];

        DB::table("payment_gateway")->insert($paymentgateways);
    }
}
