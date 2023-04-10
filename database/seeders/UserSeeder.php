<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Omar Jose Aleua',
            'email' => 'oa@gmail.com',
            'password' => Hash::make('12341234'),
        ]);

        User::create([
            'name' => 'Omar Jose Centurion',
            'email' => 'oc@gmail.com',
            'password' => Hash::make('12341234'),
        ]);
    }
}
