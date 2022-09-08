<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('measurements')->insert([
            [
                'ph' => '7',
                'ec' => '3',
                'temp' => '25',
                'soil_moisture' => '55',
                'humidity' => '70',
                'crop_id' => '1'
            ],

            [
                'ph' => '6',
                'ec' => '3',
                'temp' => '23',
                'soil_moisture' => '65',
                'humidity' => '70',
                'crop_id' => '2'
            ],

            [
                'ph' => '7',
                'ec' => '3',
                'temp' => '25',
                'soil_moisture' => '55',
                'humidity' => '70',
                'crop_id' => '3'
            ]
        ]);
    }
}
