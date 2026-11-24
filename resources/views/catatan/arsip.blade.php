@extends('layouts.app')

@section('title', 'Catatan Arsip')

@section('content')
<div class="row justify-content-between mb-3">
    <div class="col">
        <h2>Catatan Arsip</h2>
    </div>
    <div class="col-auto">
        <a href="/catatan" class="btn btn-outline-primary">&larr; Aktif</a>
    </div>
</div>

@if($catatan->count() > 0)
    <div class="row">
        @foreach($catatan as $item)
            <div class="col-md-6 mb-3">
                <div class="card border-secondary">
                    <div class="card-header text-muted">
                        {{ $item->judul }}
                        <small class="float-end">{{ $item->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ Str::limit($item->isi, 100) }}</p>
                        <a href="/catatan/{{ $item->id }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                        <form action="/catatan/{{ $item->id }}/unarchive" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Pulihkan</button>
                        </form>
                        <form action="/catatan/{{ $item->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus permanen?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        Tidak ada catatan di arsip.
        <a href="/catatan" class="ms-2">Kembali ke daftar aktif</a>
    </div>
@endif
@endsection