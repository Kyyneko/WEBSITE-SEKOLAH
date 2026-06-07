@extends('errors.layout')

@section('title', '401 — Tidak Diizinkan')

@section('icon')
    <i class="fas fa-lock"></i>
@endsection

@section('code', '401')

@section('heading', 'Akses Tidak Diizinkan')

@section('message', 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan masuk terlebih dahulu dengan akun yang terdaftar.')
