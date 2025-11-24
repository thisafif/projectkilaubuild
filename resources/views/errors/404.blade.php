@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', 'Zona Pembangunan')

@section('description_italic', 'Halaman belum siap tampil, pondasi masih ditata.')
@section('description_bold', 'Mulai konsultasi awal gratis dan susun rencana proyekmu bersama Kilau Build!')

@section('buttons')
    <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>
    <a href="{{ url('/konsultasi') }}" class="btn-home">Konsultasi Sekarang</a>
@endsection