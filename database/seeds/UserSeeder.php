<?php

use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => bcrypt('123456789'),
            'role_id' => '1',
            'phone' => '01234567890',
        ]);
        \App\User::firstOrCreate([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => bcrypt('123456789'),
            'hospital_id' => '1',
            'role_id' => '2',
            'phone' => '01234567890',
        ]);
        \App\User::firstOrCreate([
            'name' => 'test3',
            'email' => 'medo_emad2011@yahoo.com',
            'password' => bcrypt('123456789'),
            'hospital_id' => '2',
            'role_id' => '2',
            'phone' => '01236767890',
        ]);
    }
}
