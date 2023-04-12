<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        // $mailArray = array('hotmail','gmail','yandex','yahoo','outlook');
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@'.$mailArray[array_rand($mailArray,1)].'.com',
        //     'password' => Hash::make('1234'),
        // ]);
        
    }
}
