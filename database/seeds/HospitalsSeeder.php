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
            'hospital_name' => 'Shoubra Hospital',
            'address' => '29 Baktomar, Al Mabyadah, Rawd Al Farag, Cairo Governorate, Egypt',
            'phone' => '01234567890',
            'email' => 'test@test.com1',
            'lat' => '30.08',
            'lng' => '31.24',
        ]);
    }
}
