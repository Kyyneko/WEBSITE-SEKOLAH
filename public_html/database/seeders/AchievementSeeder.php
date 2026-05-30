<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'title' => 'Juara 2 Lomba Cerdas Cermat Kabupaten',
                'category' => 'Akademik',
                'medal' => 'silver',
                'student' => 'Tim LCC SMPN 14',
                'date' => 'Oktober 2024',
                'location' => 'Kab. Bulukumba',
                'description' => 'Tim cerdas cermat berhasil meraih juara 2 dalam lomba tingkat kabupaten mengalahkan puluhan tim dari sekolah lain.',
            ],
            [
                'title' => 'Juara 1 Lomba Lari 100m Tingkat Kecamatan',
                'category' => 'Olahraga',
                'medal' => 'gold',
                'student' => 'Ahmad Fauzan',
                'date' => 'Agustus 2024',
                'location' => 'Kec. Bulukumpa',
                'description' => 'Siswa kelas IX meraih medali emas cabang lari 100 meter dalam perlombaan peringatan HUT RI ke-79.',
            ],
            [
                'title' => 'Juara 3 Festival Seni Budaya Daerah',
                'category' => 'Seni',
                'medal' => 'bronze',
                'student' => 'Tim Seni SMPN 14',
                'date' => 'November 2024',
                'location' => 'Kab. Bulukumba',
                'description' => 'Penampilan tari tradisional dari tim seni berhasil meraih juara 3 dalam Festival Seni Budaya tingkat kabupaten.',
            ],
            [
                'title' => 'Juara 1 Olimpiade Matematika Kecamatan',
                'category' => 'Akademik',
                'medal' => 'gold',
                'student' => 'Nurhalisa',
                'date' => 'September 2024',
                'location' => 'Kec. Bulukumpa',
                'description' => 'Siswi kelas VIII meraih medali emas dalam Olimpiade Matematika tingkat kecamatan dan mewakili ke tingkat kabupaten.',
            ],
            [
                'title' => 'Juara 1 Turnamen Bola Voli Antar SMP',
                'category' => 'Olahraga',
                'medal' => 'gold',
                'student' => 'Tim Voli Putra',
                'date' => 'Juli 2024',
                'location' => 'Kec. Bulukumpa',
                'description' => 'Tim bola voli putra meraih juara 1 dalam turnamen antar SMP se-kecamatan Bulukumpa.',
            ],
            [
                'title' => 'Juara 2 Lomba Pidato Bahasa Indonesia',
                'category' => 'Seni',
                'medal' => 'silver',
                'student' => 'Siti Aisyah',
                'date' => 'Mei 2024',
                'location' => 'Kab. Bulukumba',
                'description' => 'Siswi kelas VIII meraih juara 2 dalam lomba pidato Bahasa Indonesia tingkat kabupaten dengan tema pendidikan karakter.',
            ],
        ];

        foreach ($achievements as $achievement) {
            $photoPath = null;
            if ($achievement['title'] === 'Juara 1 Turnamen Bola Voli Antar SMP') {
                $photoPath = 'public/achievements/voli.jpg';
            } elseif ($achievement['title'] === 'Juara 2 Lomba Cerdas Cermat Kabupaten') {
                $photoPath = 'public/achievements/lcc.jpg';
            } elseif ($achievement['title'] === 'Juara 1 Lomba Lari 100m Tingkat Kecamatan') {
                $photoPath = 'public/achievements/lari.jpg';
            }

            Achievement::create([
                'title' => $achievement['title'],
                'category' => $achievement['category'],
                'medal' => $achievement['medal'],
                'student' => $achievement['student'],
                'date' => $achievement['date'],
                'location' => $achievement['location'],
                'description' => $achievement['description'],
                'photo_path' => $photoPath,
            ]);
        }
    }
}
