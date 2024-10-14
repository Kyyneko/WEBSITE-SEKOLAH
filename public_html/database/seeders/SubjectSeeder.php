<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['name' => 'Seni Budaya'],
            ['name' => 'Matematika'],
            ['name' => 'Bahasa Indonesia'],
            ['name' => 'Bahasa Inggris'],
            ['name' => 'Fisika'],
            ['name' => 'Kimia'],
            ['name' => 'Biologi'],
            ['name' => 'Sejarah'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
