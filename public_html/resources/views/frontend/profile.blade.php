@extends('frontend/main')

@section('style')
    <link rel="stylesheet" href="css/frontend/profile.css">
    <style>
         @media (max-width: 654px) {
            .text-infoo  {
                text-align: justify;
            }
            .float-text {
                display:none;
            }
    }
  }
    </style>
@endsection

@section('content')
    {{-- Title dan Kalimat Tetap --}}
    <div class="float-text">
        <h1>UPT SPF SMPN 14 BULUKUMBA</h1>
        <p> SMPN 14 Bulukumba adalah sebuah sekolah menengah pertama yang terletak di Kabupaten Bulukumba, Sulawesi
            Selatan, Indonesia. Sekolah ini dikenal sebagai lembaga pendidikan yang berkomitmen untuk memberikan
            pendidikan berkualitas kepada para siswa. Dengan fasilitas yang memadai dan tenaga pendidik yang
            berdedikasi, SMPN 14 Bulukumba bertujuan untuk membantu siswa mengembangkan potensi akademis,
            keterampilan sosial, dan nilai-nilai moral. Sekolah ini aktif dalam berbagai kegiatan ekstrakurikuler
            dan pengembangan karakter, menciptakan lingkungan belajar yang positif dan mendukung bagi para siswa.</p>
    </div>

    {{-- Carousel --}}
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="overlay"></div> {{-- Lapisan abu-abu transparan --}}
                <img src="image/homePic/3.jpg" class="d-block w-100 img-fluid" alt="...">
            </div>
            <div class="carousel-item">
                <div class="overlay"></div> {{-- Lapisan abu-abu transparan --}}
                <img src="image/homePic/2.jpg" class="d-block w-100 img-fluid" alt="...">
            </div>
            <div class="carousel-item">
                <div class="overlay"></div> {{-- Lapisan abu-abu transparan --}}
                <img src="image/homePic/1.jpg" class="d-block w-100 img-fluid" alt="...">
            </div>
        </div>
    </div>


    {{-- Statistic --}}
    <section class="section-statistics">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-3 text-center rounded shadow mx-2 py-3 text-light statistic-item">
                    <h3>Guru</h3>
                    <h4 class="fw-light">24</h4>
                </div>
                <div class="col-3 text-center rounded shadow mx-2 py-3 text-light statistic-item">
                    <h3>Staff</h3>
                    <h4 class="fw-light">0</h4>
                </div>
                <div class="col-3 text-center rounded shadow mx-2 py-3 text-light statistic-item">
                    <h3>Siswa</h3>
                    <h4 class="fw-light">380</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="kepsek mx-auto p-2">
        <div class="title mx-auto">
            KEPALA SEKOLAH
        </div>
        <div class="img mx-auto p-2">
            <img class="rounded-1" src="storage/public/kepsek/Foto_Kepsek.jpg" alt="" width="300" height="400">
            <h4 class="p-3">Andi Tenri Awaru,S.Pd</h4>
        </div>
        <div class="sambutan mx-5 mt-4 mb-5">
                <strong> <i>"Selamat datang di website resmi UPT SPF SMPN 14 Bulukumba!! Kami dengan bangga menyambut Anda untuk menjelajahi berbagai informasi terkini seputar kegiatan, prestasi, dan perkembangan pendidikan di sekolah kami. Melalui platform ini, kami berkomitmen untuk memperkuat kolaborasi antara sekolah, siswa, orang tua, dan masyarakat. Terima kasih atas dukungan Anda dalam mewujudkan visi dan misi kami untuk memberikan pendidikan berkualitas dan mempersiapkan generasi masa depan yang tangguh. Selamat menikmati pengalaman menjelajahi website ini!"</i></strong>
        </div>
    </section>


    {{-- Sejarah Sekolah --}}
    <section class="sejarah p-2">
        <div class="title mx-auto text-center">
            SEJARAH SMPN 14 BULUKUMBA
        </div>
        <div class="content mx-5 mt-4" >
            <p style="text-align:justify">
                SMP Negeri 14 Bulukumba yang dulunya bernama SMP Negeri 1 berdiri di atas tanah persawahan yang diwakafkan
                oleh masyarakat di Tanete - Bulukumpa. Pada tahun 1961 di bawah pimpinan Distrik atau Karaeng Tanete Andi
                Abd.Syukur atau istilahnya sekarang adalah kecamatan atau Camat mulailah dirintis pendirian sekolah yang
                cukup sederhana yang bernama SMP Negeri 1 Tanete. Kemudian usaha ini dilanjutkan Karaeng Mansur,sebagai
                Karaeng Tanete sehingga pada akhirnya sistem pemerintahan berubah dari distrik Bulukumpa menjadi Kecamatan
                Bulukumpa. <br> <br>

                Sejak itulah,dirintis sebuah lembaga pendidikan yang cukup sederhana untuk masyarakat Kecamatan Bulukumpa
                dan sekitarnya yang di nakhodai pertama pada tahun 1961 oleh Bapak Abd.Wahab Dg.Culle. dan sampai sekarang
                ini SMP Negeri 1 Bulukumpa menjadi sekolah favorit yang telah banyak mengeluarkan generasi masa depan bagi
                bangsa dan tanah air yang tercinta. Sejak berdirinya SMP Negeri 1 Bulukumpa sampai sekarang sudah 15 kali
                pergantian tongkat estafet top leadhernya (kepala sekolah) yakni dari tahun 1961 sampai tahun 2013. Seiring
                perkembangan zaman SMP Negeri 1 Bulukumpa mengalami juga perubahan yang signifikan bukan hanya Kepala
                Sekolah yang sering berganti,akan tetapi juga ada perubahan dari segi sarana dan Prasarana,Tenaga edukasi
                dan staf pegawainya bahkan peserta didiknya juga mengalami perkembangan yang cukup pesat. <br> <br>

                Selain itu pada tahun 2012 SMP Negeri 1 Bulukumpa berubah statusnya menjadi SMP Negeri 14 Bulukumba
                berdasarkan adanya kebijakan Pemerintah Daerah Kabupaten Bulukumba dalam rangka penataan pendidikan menengah
                pertama,hal ini diperkuat dengan Keputusan Bupati Bulukumba Nomor : kpts.241/V/2012 tentang penetapan
                sekolah menengah pertama negeri (SMPN) dan sekolah menengah pertama negeri satu atap (SMPN SATAP) di wilayah
                kabupaten Bulukumba. <br> <br>
            </p>
        </div>

        {{-- Data Kepala Sekolah --}}
        <section class="dataKepsek p-2 mb-5">
            <h1 class="title text-center text-uppercase">Kepala Sekolah Yang Pernah Menjabat</h1>
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/001.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Abd.Wahab Dg.Culle
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/002.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Muh.Ansar Dg. Djuppa
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/003.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Muh.Yahya Nur
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/004.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        A.Ambo Tuwo Paki
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/005.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Abd.Muin Hamili
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/006.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Muslimin Bibu
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/007.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Abd.Latif Nonci
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/008.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Mahamuddin
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/009.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        A.Makmur Andi Accing
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/010.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        A.Muh.Jafar Beddang
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/011.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        A.Pananrangi
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/012.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Abd.Muis
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/013.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Amiruddin Umar
                                    </p>
                                </div>
                            </div>
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 12rem;">
                                <img class="mx-auto" src="storage/public/kepsek/014.jpg" class="card-img-top" alt="..."
                                    style="width: 150px;">
                                <div class="card-body">
                                    <p class="card-text text-center">
                                        Jumrah
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>


    </section>

    {{-- Akreditasi --}}
    <section class="akreditasi text-center mx-auto p-5" style="background-color: rgb(19,123,191); color: white;">
        <div class="title mx-auto">
            DATA SEKOLAH
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-start p-2">
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <th>NPSN</th>
                        <td>:</td>
                        <td>40304206</td>
                    </tr>
                    <tr>
                        <th>Kepala Sekolah</th>
                        <td>:</td>
                        <td>Andi Tenri Awaru,S.Pd</td>
                    </tr>
                    <tr>
                        <th>Admin</th>
                        <td>:</td>
                        <td>Muhammad Amin</td>
                    </tr>
                    <tr>
                        <th>Akreditasi</th>
                        <td>:</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <th>Kurikulum</th>
                        <td>:</td>
                        <td>Kurikulum Merdeka</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>Negeri</td>
                    </tr>
                    <tr>
                        <th>Bentuk Kepemilikan</th>
                        <td>:</td>
                        <td>SMP</td>
                    </tr>
                    <tr>
                        <th>Status Kepemilikan</th>
                        <td>:</td>
                        <td>Pemerintah Daerah</td>
                    </tr>
                    <tr>
                        <th>SK Pendirian Sekolah</th>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Tanggal SK Pendirian</th>
                        <td>:</td>
                        <td>1960-01-01</td>
                    </tr>
                    <tr>
                        <th>Status Kepemilikan</th>
                        <td>:</td>
                        <td>Pemerintah Daerah</td>
                    </tr>
                </table>
                <a class="mx-auto p-2 btn btn-info" style="text-decoration: none;color:#ffffff"
                    href="https://dapo.kemdikbud.go.id/sekolah/F18288208300F6387361#" target="blank">
                    Selengkapnya Disini >>
                </a>
            </div>
            <div class="col-12 col-md-6 text-center mx-auto mt-4">
                <img src="image/Logo.png" alt="" width="300">
            </div>
        </div>
    </section>



    {{-- Visi & Misi --}}
    <section class="visiMisi p-5" style="background-color: #ffffff;color:#000000">
        <div class="title text-center">
            VISI & MISI
        </div>
        <div class="isi">
            <strong>VISI</strong><br>
            <p class="text text-justify">
                <strong>
                    <i> "Berprestasi dalam bidang akademik dan non akademik berdasarkan imtaq serta berperan aktif dalam
                        mencegah
                        pencemaran dan kerusakan lingkungan hidup berdasarkan imtaq,iptek dan norma"
                    </i>
                </strong>
            </p>
            <hr>
            <strong>MISI</strong><br>
            <ul class="text text-justify">
                Untuk mencapai visi tersebut, perlu dilakukan suatu misi berupa kegiatan jangka panjang dengan arah yang
                jelas. Berikut ini merupakan misi yang dirumuskan berdasarkan visi di atas adalah :
                <li>Melaksanakan penerimaan siswa baru (PSB) secara bertahap, transparan, dan obyektif.</li>
                <li>Meningkatkan kedisiplinan warga sekolah dalam rangka menciptakan sumber daya manusia (SDM) yang
                    berkualitas, demi terwujudnya sekolah berwawasan peduli lingkungan.</li>
                <li>Melaksanakan Kurikulum 2013 (K13) secara efisien serta inovasi pembelajaran yang bernuansa IMTAQ, IPTEK,
                    dan wawasan lingkungan.</li>
                <li>Penyediaan dan pemanfaatan sarana serta prasarana bidang akademik dalam rangka pengembangan sekolah dan
                    peningkatan mutu pendidikan.</li>
                <li>Melaksanakan ulangan umum, harian, analisis, remedial, dan pengayaan secara optimal dalam rangka
                    memperoleh peningkatan selisih nilai UAS/UAN.</li>
                <li>Menerapkan manajemen partisipatif dengan melibatkan warga masyarakat, komite sekolah, dan pemerintah
                    dalam rangka pengembangan sekolah dan peningkatan mutu pendidikan yang dilandasi nilai-nilai IMTAQ,
                    IPTEK, dan wawasan lingkungan.</li>
                <li>Memberdayakan potensi lingkungan untuk pengembangan keterampilan produktif, demi terciptanya sekolah
                    yang berwawasan peduli lingkungan.</li>
            </ul>

        </div>
    </section>

    {{-- Info 1 --}}
    <div class="info p-5" style="background-color: rgb(19,123,191);color:white">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 text-center mx-auto">
                <img src="image/LogoKemendikbud.png" alt="" width="300">
            </div>
            <div class="text-infoo col-12 col-md-6 text-justify p-2">
                <strong style="font-family: 'Courier New', Courier, monospace">KEMENTRIAN PENDIDIKAN,KEBUDAYAAN,RISET DAN
                    TEKNOLOGI
                </strong><br>
                Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek) adalah kementerian dalam
                Pemerintah Indonesia yang menyelenggarakan urusan di bidang pendidikan anak usia dini, pendidikan dasar,
                pendidikan menengah, pendidikan vokasi, dan pendidikan tinggi; pengelolaan kebudayaan; penelitian; riset;
                dan pengembangan teknologi. Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi berada di bawah dan
                bertanggung jawab kepada Presiden Indonesia,[2] dan dipimpin oleh seorang Menteri Pendidikan, Kebudayaan,
                Riset, dan Teknologi (Mendikbudristek). <br>
                <a href="https://www.kemdikbud.go.id/" style="text-decoration: none;color:black">Selengkapnya >></a>
            </div>
        </div>
    </div>


    {{-- Info 2 --}}
    <div class="info p-5" style="background-color: #ffffff">
        <div class="row justify-content-center">
            <div class="text-infoo col-12 col-md-6 text-justify p-2">
                <strong style="font-family: 'Courier New', Courier, monospace"> MERDEKA BELAJAR
                </strong><br>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus quaerat provident eaque et, nesciunt
                libero est maiores enim. Laudantium quia, quidem eius tempore, quisquam inventore eum quasi expedita dicta
                harum quae veniam omnis odio dolorem aliquid fugit doloribus sapiente non, incidunt corrupti quis aliquam
                asperiores sunt maxime? Ab, suscipit excepturi! Incidunt molestiae eligendi, modi numquam at autem
                laudantium aspernatur beatae quaerat assumenda adipisci unde totam ea quae alias maiores ad earum?
                Repudiandae, quod? Pariatur ea praesentium labore rem dolor. Tempore, ea, et repudiandae veritatis nesciunt,
                cumque atque modi asperiores beatae ducimus assumenda quas ab explicabo praesentium. Non perferendis
                blanditiis iure?
            </div>
            <div class="col-12 col-md-6 text-center mx-auto mt-3">
                <img src="image/LogoKurMer.png" alt="" width="300">
            </div>
        </div>
    </div>
@endsection
