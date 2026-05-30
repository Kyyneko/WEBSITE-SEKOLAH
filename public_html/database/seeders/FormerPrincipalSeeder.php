<?php

namespace Database\Seeders;

use App\Models\FormerPrincipal;
use Illuminate\Database\Seeder;

class FormerPrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kepsekList = [
            ['name' => 'Budi Santoso, S.Pd', 'period' => '1994 - 1996'],
            ['name' => 'Siti Lestari, M.Pd', 'period' => '1996 - 1998'],
            ['name' => 'Agus Pratama, S.Pd', 'period' => '1998 - 2000'],
            ['name' => 'Dewi Rahmawati, M.Pd', 'period' => '2000 - 2002'],
            ['name' => 'Andi Fikri, S.Pd', 'period' => '2002 - 2004'],
            ['name' => 'Nina Kusuma, M.Pd', 'period' => '2004 - 2006'],
            ['name' => 'Rafi Alamsyah, S.Pd', 'period' => '2006 - 2008'],
            ['name' => 'Lina Purnama, M.Pd', 'period' => '2008 - 2010'],
            ['name' => 'Joko Wiryawan, S.Pd', 'period' => '2010 - 2012'],
            ['name' => 'Mira Anggraini, M.Pd', 'period' => '2012 - 2015'],
            ['name' => 'Dimas Kurnia, S.Pd', 'period' => '2015 - 2018'],
            ['name' => 'Rasya Nugraha, S.Pd', 'period' => '2018 - 2021'],
            ['name' => 'Intan Maharani, M.Pd', 'period' => '2021 - 2024'],
            ['name' => 'Yudha Saputra, S.Pd', 'period' => '2024 - 2026'],
        ];

        foreach ($kepsekList as $kepsek) {
            FormerPrincipal::create([
                'name' => $kepsek['name'],
                'period' => $kepsek['period'],
                'photo_path' => null, // siluet fallback
            ]);
        }
    }
}
