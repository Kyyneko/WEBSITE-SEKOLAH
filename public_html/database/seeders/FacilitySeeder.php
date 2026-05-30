<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Ruang Kelas',
                'category' => 'Akademik',
                'description' => 'Ruang kelas yang nyaman dan dilengkapi dengan meja, kursi, papan tulis, serta ventilasi yang baik untuk menunjang proses belajar mengajar.',
                'features' => ['Ventilasi Baik', 'Pencahayaan Cukup', 'Kapasitas 32 Siswa'],
            ],
            [
                'name' => 'Perpustakaan',
                'category' => 'Akademik',
                'description' => 'Perpustakaan sekolah menyediakan berbagai koleksi buku pelajaran, buku bacaan umum, dan referensi untuk menunjang literasi siswa.',
                'features' => ['Koleksi Lengkap', 'Ruang Baca Nyaman'],
            ],
            [
                'name' => 'Laboratorium IPA',
                'category' => 'Akademik',
                'description' => 'Laboratorium IPA dilengkapi peralatan praktikum untuk mata pelajaran Fisika, Kimia, dan Biologi sesuai kurikulum.',
                'features' => ['Alat Praktikum', 'Ruang Steril', 'Meja Lab', 'Ventilasi Khusus'],
            ],
            [
                'name' => 'Laboratorium Komputer',
                'category' => 'Teknologi',
                'description' => 'Ruang komputer dilengkapi unit PC dan jaringan internet untuk kegiatan pembelajaran TIK dan ujian berbasis komputer.',
                'features' => ['Unit Komputer', 'Koneksi Internet'],
            ],
            [
                'name' => 'Lapangan Olahraga',
                'category' => 'Olahraga',
                'description' => 'Lapangan olahraga untuk kegiatan pendidikan jasmani, upacara bendera, dan berbagai kegiatan luar ruangan.',
                'features' => ['Lapangan Serbaguna', 'Area Upacara', 'Lintasan'],
            ],
            [
                'name' => 'Musholla',
                'category' => 'Ibadah',
                'description' => 'Tempat ibadah yang bersih dan nyaman untuk kegiatan sholat berjamaah dan kegiatan keagamaan lainnya.',
                'features' => ['Bersih & Nyaman', 'Perlengkapan Sholat'],
            ],
        ];

        foreach ($facilities as $facility) {
            $photoPath = null;
            if ($facility['name'] === 'Ruang Kelas') {
                $photoPath = 'public/facilities/kelas.jpg';
            } elseif ($facility['name'] === 'Perpustakaan') {
                $photoPath = 'public/facilities/perpustakaan.jpg';
            } elseif ($facility['name'] === 'Laboratorium IPA') {
                $photoPath = 'public/facilities/lab.jpg';
            }

            Facility::create([
                'name' => $facility['name'],
                'category' => $facility['category'],
                'description' => $facility['description'],
                'features' => $facility['features'],
                'photo_path' => $photoPath,
            ]);
        }
    }
}
