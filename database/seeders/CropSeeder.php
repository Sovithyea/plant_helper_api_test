<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('crops')->insert([
            [
                'name' => 'Banana',
            ],

            [
                'name' => 'Apple',
            ],
            
            [
                'name' => 'Mango',
            ]
        ]);
        
    }
}
