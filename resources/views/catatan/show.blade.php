@extends('layouts.app')

@section('title', $catatan->judul)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $catatan->judul }}</h5>
                @if($catatan->is_archived)
                    <span class="badge bg-secondary">Diarsipkan</span>
                @endif
            </div>

            <div class="card-body">
                <p class="card-text">{!! nl2br(e($catatan->isi)) !!}</p>
            </div>

            <div class="card-footer text-end">
                <a href="/catatan" class="btn btn-secondary">&larr; Kembali</a>
                <a href="/catatan/{{ $catatan->id }}/edit" class="btn btn-warning">Edit</a>

                @if($catatan->is_archived)
                    <form action="/catatan/{{ $catatan->id }}/unarchive" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Batalkan Arsip</button>
                    </form>
                @else
                    <form action="/catatan/{{ $catatan->id }}/archive" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary"
                                onclick="return confirm('Arsipkan catatan ini?')">
                            Arsipkan
                        </button>
                    </form>
                @endif

                <form action="/catatan/{{ $catatan->id }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Hapus catatan ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection