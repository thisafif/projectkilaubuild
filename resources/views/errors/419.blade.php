@extends('errors::minimal')

@section('title', 'Page Expired')
@section('code', '419')
@section('message', 'Safety Lock Activated')

@section('description_italic', 'Silakan masuk kembali ke akun untuk melanjutkan.')
@section('description_bold', 'Untuk menjaga keamanan “struktur proyek”, sistem otomatis mengunci akses karena sesi sudah kedaluwarsa.')

@section('buttons')
    <a href="{{ url('/admin') }}" class="btn-home">Login Kembali</a>
@endsection