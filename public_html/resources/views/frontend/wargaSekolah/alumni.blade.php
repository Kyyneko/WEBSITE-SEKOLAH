@extends('frontend/main')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/frontend/alumni.css') }}">
@endsection

@section('content')
    <div class="dataSiswa text-center" style="margin-top: 70px">
        <div class="title p-5">
            DATA ALUMNI
        </div>
        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Tempat,Tanggal Lahir</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Angkatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mahendra Kirana M.B</td>
                    <td>Palopo, 21 Agustus 2004</td>
                    <td>Bulukumba</td>
                    <td>2019</td>
                </tr>
                <tr>
                    <td>Alfian</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <td>Dwi</td>
                    <td>Larry the Bird</td>
                    <td>Haii</td>
                    <td>Maaa</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
