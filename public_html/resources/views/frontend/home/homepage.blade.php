@extends('frontend/main')
@section('style')
    <style>
        #carouselExampleFade {
    max-height: 600px;
    overflow: hidden;
    position: relative;
}

#carouselExampleFade .carousel-inner img {
    height: 100%;
    object-fit: contain;
}

#carouselExampleFade .carousel-inner .img-fluid {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
}

.float-text {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
    z-index: 2;
    width: 80%;
    max-width: 600px; /* Set a maximum width if needed */
}

.float-text h1 {
    font-family: 'Courier New', Courier, monospace;
    color: rgb(19, 123, 191);
    font-weight: 900;
    font-size: 3vw;
}

.float-text p {
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    color: white;
    font-weight: 500;
    font-size: 1.5vw;
}

/* Add this CSS to your existing stylesheet */
.navbar-nav .nav-item .nav-link {
    position: relative;
    transition: color 0.3s ease-in-out;
  }
  
  .navbar-nav .nav-item .nav-link::before {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #000000;
    transition: width 0.3s ease-in-out;
  }
  
  .navbar-nav .nav-item .nav-link:hover::before {
    width: 100%;
  }
  
  .navbar-nav .nav-item .nav-link:hover {
    color: #000000;
  }


 @media (max-width: 654px) {
    .float-text{
        display:none;
    }
  }


.carousel-control-prev,
.carousel-control-next {
    display: none;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.614); /* Warna abu-abu dengan tingkat kejernihan (opacity) 0.5 */
}

.section-statistics {
    margin-top: -60px;
    position: relative;
    z-index: 999;
}

.statistic-item {
    background-color: rgb(41, 123, 191);
}

.section-services,
.section-quality {
    padding-top: 11%;
    padding-bottom: 11%;
}

.section-testimoni {
    padding-top: 4%;
    padding-bottom: 4%;
}

#adsCarousel {
    transform: rotate(-90deg);
    transform-origin: right top;
    height: 100%;
}

.carousel-inner {
    display: flex;
    flex-direction: row;
}

.carousel-item {
    width: 100%; /* Sesuaikan lebar dengan kebutuhan */
}

.carousel-item.active {
    display: flex;
    flex-direction: column;
}

.carousel-control-prev,
.carousel-control-next {
    transform: rotate(90deg);
    transform-origin: center;
}
.loading {
    --speed-of-animation: 0.9s;
    --gap: 6px;
    --first-color: #4c86f9;
    --second-color: #49a84c;
    --third-color: #f6bb02;
    --fourth-color: #f6bb02;
    --fifth-color: #2196f3;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
    background: rgba(255, 255, 255, 0.8); /* Transparent background overlay */
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
}

.loading span {
    width: 4px;
    height: 50px;
    background: var(--first-color);
    animation: scale var(--speed-of-animation) ease-in-out infinite;
}

.loading span:nth-child(2) {
    background: var(--second-color);
    animation-delay: -0.8s;
}

.loading span:nth-child(3) {
    background: var(--third-color);
    animation-delay: -0.7s;
}

.loading span:nth-child(4) {
    background: var(--fourth-color);
    animation-delay: -0.6s;
}

.loading span:nth-child(5) {
    background: var(--fifth-color);
    animation-delay: -0.5s;
}

@keyframes scale {
    0%, 40%, 100% {
        transform: scaleY(0.05);
    }

    20% {
        transform: scaleY(1);
    }
}

    </style>
@endsection

@section('content')
    {{-- Title dan Kalimat Tetap --}}
    <div class="float-text">
        <h1>WELCOME TO SCHOOL</h1>
        <h2>UPT SPF SMPN 14 BULUKUMBA</h2>
        <p>Sekolah Menengah Pertama Yang Berada Di Kabupaten Bulukumba Tepatnya Di Kecamatan Bulukumpa</p>
        <button type="button" class="btn" style="background-color: rgb(19, 123, 191)">
            <a href="/profil" style="text-decoration: none;color:white">
                Selengkapnya >>
            </a>
        </button>
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

    {{-- Article & Ads --}}
    <div class="container-fluid p-3 text-center">
        <div class="row">
            <hr>
            <div class="col-md-12 rounded-1 mb-3">
                <h1 class="water mb-5"
                    style="font-family: 'Cambria', Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: 800; font-size: 3rem;">
                    UPT SPF SMPN 14 BULUKUMBA
                </h1>
                <p style="margin: 10px;">
                    SMPN 14 Bulukumba adalah sebuah sekolah menengah pertama yang terletak di Kabupaten Bulukumba, Sulawesi
                    Selatan, Indonesia. Sekolah ini dikenal sebagai lembaga pendidikan yang berkomitmen untuk memberikan
                    pendidikan berkualitas kepada para siswa. Dengan fasilitas yang memadai dan tenaga pendidik yang
                    berdedikasi, SMPN 14 Bulukumba bertujuan untuk membantu siswa mengembangkan potensi akademis,
                    keterampilan sosial, dan nilai-nilai moral. Sekolah ini aktif dalam berbagai kegiatan ekstrakurikuler
                    dan pengembangan karakter, menciptakan lingkungan belajar yang positif dan mendukung bagi para siswa.
                </p>
            </div>
            <div class="col-md-12 rounded-1 mx-auto p-3">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item img-fluid"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.557638887232!2d120.13798547365488!3d-5.331467094647059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbea74944576b8f%3A0x674d040df0157620!2sSMP%20Negeri%2014%20Bulukumba!5e0!3m2!1sid!2sid!4v1706774689060!5m2!1sid!2sid"
                        width="800" height="450" style="border:1;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <hr>
        </div>
    </div>


    {{-- Carousel Article --}}
    <h1 class="fw-bold text-center" >ARTICLE</h1>
    <div id="carouselExample" class="carousel slide m-4 p-3 rounded-1" data-bs-ride="carousel"
        style="background-color: rgb(41, 123, 191)">
        <div class="carousel-inner">
            @foreach ($articles->chunk(4) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row">
                        @foreach ($chunk as $article)
                            <div class="card col-md-3 p-2 mx-auto my-2" style="width: 18rem;">
                                <a href="{{ route('article.show', $article->slug) }}"
                                    style="text-decoration: none;color:inherit">

                                    @php
                                        $photo_paths = json_decode($article->photo_path);
                                    @endphp
                                    @if (!empty($photo_paths) && is_array($photo_paths) && count($photo_paths) > 0)
                                        <img src="{{ asset('storage/' . substr($photo_paths[0], 7)) }}" class="card-img-top"
                                            alt="..." width="150">
                                    @else
                                        <p>No photo available</p>
                                    @endif
                                    <div class="card-body">
                                        <p class="card-text fw-bold" style="font-size: 9px">{{ $article->user->name }} <br>
                                            {{ $article->created_at->formatLocalized('%A, %d %B %Y') }}</p>
                                        <hr>
                                        <p class="card-text">
                                            {{ strlen(strip_tags($article->description)) > 100 ? substr(strip_tags($article->description), 0, 100) . '...' : strip_tags($article->description) }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    {{-- Ads --}}
    <hr>
   <div class="ads col-md-8 col-lg-6 rounded-1 mb-3 p-4 mx-auto">
        <div class="row justify-content-between">
            @foreach ($ads as $ad)
                <a href="{{ $ad->link }}" target="_blank" class="text-decoration-none text-dark">
                    <div class="card mb-3" style="width: 14rem;">
                        <img src="{{ $ad->photo_path ? asset('storage/' . $ad->photo_path) : asset('storage/public/photos/Default_Photo_Landscape.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <p class="card-text">{!! $ad->description !!}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleFade'), {
                interval: 3000, // Sesuaikan dengan interval yang diinginkan (dalam milidetik)
                wrap: true // Untuk memastikan carousel berganti gambar secara terus-menerus
            });
        });
    </script>
@endsection
