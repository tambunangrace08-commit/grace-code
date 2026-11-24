@extends('layouts.app')

@section('title', $catatan->judul)

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">{{ $catatan->judul }}</h2>
        <small class="text-muted">{{ $catatan->created_at->format('d M Y H:i') }}</small>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $catatan->isi }}</p>
        <a href="{{ route('catatan.edit', $catatan) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('catatan.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
</div>
@endsection
