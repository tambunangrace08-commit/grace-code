@extends('layouts.app')

@section('title', 'Halo Dunia')

@section('content')
<div class="text-center">
    <h2>{{ $pesan }}</h2>
    <p class="lead">Dikirim dari Controller pada pukul {{ $timestamp }}</p>
    <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection