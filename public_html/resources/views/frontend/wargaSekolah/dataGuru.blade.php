@extends('frontend/main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/wargaSekolah/dataGuru.css') }}">
@endsection

@section('content')
    <div class="title p-5 text-center" style="margin-top: 80px" data-aos="zoom-in">Data Pegawai</div>
    <div class="row mx-auto p-3 justify-content-center">
        @foreach ($users as $user)
            <div class="card col-md-3" style="width: 18rem;" data-aos="fade-up">
                @if (!empty($user->photo_path))
                    <img src="{{ asset('storage/' . $user->photo_path) }}"
                        style="width: 263px; height: 263px; border-radius: 50%;" alt="...">
                @else
                    <img src="{{ asset('storage/photos/Default_Photo.svg') }}" class="card-img-top" alt="...">
                @endif

                <div class="card-body">
                    <p class="card-text text-center">{{ $user->name }}</p>
                    @if (!empty($user->subject->name))
                        <p class="card-text text-center fw-bold">{{ $user->subject->name }}</p>
                    @else
                        <p class="card-text text-center fw-bold">Belum Ditentukan</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
