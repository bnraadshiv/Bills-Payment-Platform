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
        //create admin user

        User::factory()->create([
            'first_name' => "Lanre",
            'last_name' => "Lanre",
            'email' => 'lanreogunya@yahoo.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);


    }


}
