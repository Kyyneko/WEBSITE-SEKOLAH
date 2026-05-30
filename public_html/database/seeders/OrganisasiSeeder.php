<?php

namespace Database\Seeders;

use App\Models\Organisasi;
use Illuminate\Database\Seeder;

class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organisasis = [
            [
                'nama' => 'OSIS',
                'slug' => 'osis',
                'description' => 'Organisasi Siswa Intra Sekolah UPT SPF SMPN 14 Bulukumba.',
            ],
            [
                'nama' => 'Pramuka',
                'slug' => 'pramuka',
                'description' => 'Gerakan Pramuka Gugus Depan UPT SPF SMPN 14 Bulukumba.',
            ],
            [
                'nama' => 'PMR',
                'slug' => 'pmr',
                'description' => 'Palang Merah Remaja UPT SPF SMPN 14 Bulukumba.',
            ],
            [
                'nama' => 'Paskibra',
                'slug' => 'paskibra',
                'description' => 'Pasukan Pengibar Bendera UPT SPF SMPN 14 Bulukumba.',
            ],
        ];

        foreach ($organisasis as $organisasi) {
            Organisasi::create($organisasi);
        }
    }
}
