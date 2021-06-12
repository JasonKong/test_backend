<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        dd(Str::random(60));
        DB::table('users')->insert([
            'name' => 'Jason Kong',
            'email' => 'jasonkongnz@gmail.com',
            'password' => Hash::make('12345678'),
            'api_token' => Str::random(60),
        ]);
    }
}
