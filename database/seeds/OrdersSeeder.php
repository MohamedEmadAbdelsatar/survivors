<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Orders::firstOrCreate([
            'hospital_id' => '1',
            'user_id' => '2',
            'blood_type' => '1',
            'amount' => '5',
            'status' => '1',
            'to_id' => '2',
            'try' => '1',
        ]);
        \App\Orders::firstOrCreate([
            'hospital_id' => '2',
            'user_id' => '3',
            'blood_type' => '2',
            'amount' => '3',
            'status' => '1',
            'to_id' => '1',
            'try' => '1',
        ]);
    }
}
