<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed users table with sample data
        DB::table('users')->insert([
            'name' => 'Mahendra Kirana M.B',
            'email' => 'mahendrakirana284@gmail.com',
            'email_verified_at' => now(),
            'subject_id' => '1',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('users')->insert([
            'name' => 'Muhammad Amin',
            'email' => 'myfitriamin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('11Bulukumba'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
