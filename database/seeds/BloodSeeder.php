<?php

use Illuminate\Database\Seeder;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Blood::firstOrCreate([
            'hospital_id' => '1',
        ]);
    }
}
