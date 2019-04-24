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
            'password' => '$2y$10$UBuUPxtzSL.QtFUlO500fOX/vARbnwZNGE.mg2Rtj9FL45QEBBEo2',
            'remember_token' => 'm1LYrAHqKpxaxsu1ss9iPq9WtevrAH4gQ9QgpBMyR4RT58O4U66xB3F1jzSs',
            'hospital_id' => 'null',
            'role_id' => '1',
            'phone' => 'null',
        ]);
        \App\User::firstOrCreate([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => '$2y$10$urm3nBCyL6IGc5Om5ZgXK.chHBlt7Aew6ZK4SUwXEHc.4WeKIBkVe',
            'remember_token' => 'QXOYu7h2SUCbWCQoVvTjH2OBXNd7qmiQ1H3rKhAZ3rKeCmxItZgxecX79Rwd',
            'hospital_id' => '1',
            'role_id' => '2',
            'phone' => '01234567890',
        ]);
    }
}
