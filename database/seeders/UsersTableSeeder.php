<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        DB::table('oauth_clients')->insert([
            'id' => '9706c195-7133-43cd-83cc-08da70e592e2',
            'name' => 'Password Grant Client',
            'secret' => 'SozE8kbZDH7y2IKvun6mO87Sv2ghvvH8FGzTkDBT',
            'redirect' => env('APP_URL'),
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
        ]);


        $user = new User();

        $user->first_name = "admin";
        $user->last_name = "admin";
        $user->username = "Administrator";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('12345678');
        
        $user->save();
    }
}
