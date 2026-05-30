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
        // Seed users table with exactly 1 superuser admin
        DB::table('users')->insert([
            'name' => 'Superuser',
            'email' => 'superuser',
            'email_verified_at' => now(),
            'password' => Hash::make('superuser123'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
