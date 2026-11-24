@extends('layouts.app')

@section('title', 'Daftar Catatan')

@section('content')
<div class="row justify-content-between mb-3">
    <div class="col">
        <h2>Daftar Catatan</h2>
    </div>
    <div class="col-auto">
        <a href="/catatan/tambah" class="btn btn-success">+ Tambah Baru</a>
    </div>
</div>

@if(session('sukses'))
    <div class="alert alert-success">{{ session('sukses') }}</div>
@endif

@if($catatan->count() > 0)
    <div class="row">
        @foreach($catatan as $item)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ $item->judul }}
                        <small class="text-muted float-end">{{ $item->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ Str::limit($item->isi, 100) }}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat</a>
                        <a href="#" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="#" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        Belum ada catatan. <a href="/catatan/tambah">Buat catatan pertama!</a>
    </div>
@endif
@endsection