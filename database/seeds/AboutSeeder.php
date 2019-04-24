<?php

use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\About::firstOrCreate([
            'title' => 'About US',
            'image' => 'public/5ELtoZuIWV21IfC77iM3ZmCxvPBUNBxA7ZFpapfL.png',
            'body' => '<p><strong>Here</strong> We <em>Talk About</em> Our Web Site</p>',
        ]);
    }
}
