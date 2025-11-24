@extends('errors::minimal')

@section('title', 'Server Error')
@section('code', '500')
@section('message', 'Crack Detected')

@section('description_italic', 'Halaman Rusak.')
@section('description_bold', 'Kode di balik website ini sedang bermasalah, mohon melaporkan ke pemilik situs.')

@section('buttons')
    <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>
@endsection