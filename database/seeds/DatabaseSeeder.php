<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        for($i=0;$i<100;$i++){
            DB::table('news')->insert([
                'new_title' => Str::random(10),
                'new_photo' => Str::random(10),
                'new_content' => 'This is paragraph',
                ]);
        }
    }
}
