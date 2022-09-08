<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diseases')->insert([
            [
                'name' => 'yellow leaf',
                'diagnosis' => 'yellow leaf',
                'cause' => 'hot',
                'solution' => 'watering 100 times a day',
                'crop_id' => '1'
            ],

            [
                'name' => 'red leaf',
                'diagnosis' => 'red leaf',
                'cause' => 'cold',
                'solution' => 'watering 0.5 time a day',
                'crop_id' => '2'
            ],
            
            [
                'name' => 'red leaf',
                'diagnosis' => 'red leaf',
                'cause' => 'cold',
                'solution' => 'watering 1 time a day',
                'crop_id' => '1'
            ]
        ]);
    }
}
