<?php

use Illuminate\Database\Seeder;

class HospitalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Hospital::firstOrCreate([
            'name' => 'Shoubra Hospital',
            'address' => '29 Baktomar, Al Mabyadah, Rawd Al Farag, Cairo Governorate, Egypt',
            'phone' => '12345678900',
            'email' => 'test@test.com1',
            'lat' => '30.08',
            'lng' => '31.24',
        ]);
        \App\Hospital::firstOrCreate([
            'name' => 'nasr Hospital',
            'address' => '25 Baktomar, Al Mabyadah, Rawd Al Farag, Cairo Governorate, Egypt',
            'phone' => '12367678900',
            'email' => 'test3@test.com',
            'lat' => '32.08',
            'lng' => '33.24',
        ]);
    }
}
