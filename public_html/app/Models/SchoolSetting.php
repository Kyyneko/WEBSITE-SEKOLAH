<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_name',
        'npsn',
        'akreditasi',
        'kurikulum',
        'status_sekolah',
        'bentuk_pendidikan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'dapodik_link',
        'kepsek_name',
        'kepsek_photo_path',
        'kepsek_welcome_text',
        'visi',
        'misi',
        'address',
        'phone',
        'email',
        'jumlah_siswa',
        'jumlah_staff',
        'hero_subtitle',
        'hero_description',
        'about_title',
        'about_description',
        'history_title',
        'history_description',
        'hero_photo_1',
        'hero_photo_2',
        'hero_photo_3',
        'profile_banner_photo',
    ];

    /**
     * Create and return the default school settings row if none exists.
     */
    public static function createDefault()
    {
        return self::create([
            'school_name' => 'UPT SPF SMPN 14 BULUKUMBA',
            'npsn' => '40313565',
            'akreditasi' => 'B',
            'kurikulum' => 'Kurikulum Merdeka',
            'status_sekolah' => 'Negeri',
            'bentuk_pendidikan' => 'SMP',
            'kecamatan' => 'Bulukumpa',
            'kabupaten' => 'Bulukumba',
            'provinsi' => 'Sulawesi Selatan',
            'dapodik_link' => 'https://dapo.kemdikbud.go.id/',
            'kepsek_name' => 'Drs. Syarifuddin',
            'kepsek_photo_path' => null, // Will use avatar placeholder if null
            'kepsek_welcome_text' => 'Selamat datang di website resmi UPT SPF SMPN 14 BULUKUMBA. Kami berkomitmen untuk memberikan pendidikan yang berkualitas dan berkarakter bagi seluruh peserta didik. Dengan semangat Kurikulum Merdeka, kami terus berinovasi dalam proses pembelajaran agar siswa-siswi kami tumbuh menjadi generasi yang cerdas, kreatif, dan berakhlak mulia. Semoga website ini dapat menjadi sarana informasi yang bermanfaat bagi seluruh warga sekolah dan masyarakat.',
            'visi' => 'Terwujudnya peserta didik yang beriman, bertakwa, berakhlak mulia, cerdas, terampil, dan berdaya saing tinggi berdasarkan nilai-nilai Pancasila.',
            'misi' => "Meningkatkan keimanan dan ketakwaan melalui pembiasaan dan kegiatan keagamaan.\nMengembangkan proses pembelajaran yang aktif, kreatif, efektif, dan menyenangkan.\nMeningkatkan kompetensi dan profesionalisme tenaga pendidik dan kependidikan.\nMewujudkan lingkungan sekolah yang bersih, aman, nyaman, dan kondusif.\nMengembangkan potensi siswa di bidang akademik, olahraga, seni, dan budaya.\nMenjalin kerja sama yang harmonis antara sekolah, orang tua, dan masyarakat.",
            'address' => 'Kecamatan Bulukumpa, Kabupaten Bulukumba, Sulawesi Selatan',
            'phone' => '08123456789',
            'email' => 'smpn14bulukumba@gmail.com',
            'jumlah_siswa' => 380,
            'jumlah_staff' => 12,
            'hero_subtitle' => 'Membentuk Generasi Cerdas, Berkarakter, dan Berprestasi',
            'hero_description' => 'Sekolah menengah pertama yang berkomitmen memberikan pendidikan berkualitas dengan pendekatan modern dan lingkungan belajar yang inspiratif di Kabupaten Bulukumba.',
            'about_title' => 'Profil Singkat Sekolah',
            'about_description' => 'Berlokasi di Kabupaten Bulukumba, Sulawesi Selatan, UPT SPF SMPN 14 BULUKUMBA hadir sebagai lembaga pendidikan terdepan yang berupaya mencetak generasi penerus bangsa yang siap bersaing global dengan mengedepankan kearifan lokal.',
            'history_title' => 'Sejarah Sekolah',
            'history_description' => "UPT SPF SMPN 14 BULUKUMBA didirikan sebagai bentuk kepedulian pemerintah daerah terhadap pemerataan pendidikan di Kabupaten Bulukumba. Sekolah ini berdiri di wilayah Kecamatan Bulukumpa dengan tujuan menyediakan akses pendidikan menengah pertama yang berkualitas bagi masyarakat sekitar.\n\nSepanjang perjalanannya, sekolah ini terus mengalami perkembangan baik dari segi infrastruktur, sumber daya manusia, maupun prestasi akademik dan non-akademik. Berbagai kegiatan pembinaan siswa, pelatihan guru, dan peningkatan fasilitas terus dilakukan demi menciptakan lingkungan belajar yang kondusif dan inspiratif.\n\nDengan dukungan dari berbagai pihak, UPT SPF SMPN 14 BULUKUMBA kini menjadi salah satu sekolah yang diperhitungkan di tingkat kabupaten, menghasilkan lulusan yang siap melanjutkan ke jenjang pendidikan yang lebih tinggi dan berkontribusi positif bagi masyarakat.",
            'hero_photo_1' => null,
            'hero_photo_2' => null,
            'hero_photo_3' => null,
            'profile_banner_photo' => null,
        ]);
    }
}
