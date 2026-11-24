@extends('layouts.app')

@section('title', 'Daftar Catatan')

@section('content')
<div class="row justify-content-between mb-3">
    <div class="col">
        <h2>Catatan Aktif</h2>
        <p class="text-muted mb-1">Kamu punya {{ $jumlah_aktif }} catatan aktif.</p>
        <a href="/catatan/import" class="btn btn-outline-info btn-sm">Impor CSV</a>
    </div>
    <div class="col-auto">
        <a href="/catatan/export" class="btn btn-outline-success me-2">
            <i class="fas fa-file-csv"></i> Ekspor CSV
        </a>
        <a href="/catatan/arsip" class="btn btn-outline-secondary me-2">
            Arsip ({{ App\Models\Catatan::where('user_id', auth()->id())->where('is_archived', true)->count() }})
        </a>
        <a href="/catatan/tambah" class="btn btn-success">+ Tambah Baru</a>
    </div>
</div>

@if(session('sukses'))
    <div class="alert alert-success">{{ session('sukses') }}</div>
@endif

<div class="d-flex gap-2 mb-4">
    <form method="GET" action="/catatan" class="flex-fill">
        <div class="input-group">
            <input type="text" name="cari" class="form-control"
                   placeholder="Cari judul atau isi..." value="{{ request('cari') }}">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
            @if(request('cari'))
                <a href="/catatan" class="btn btn-outline-secondary">&#10005; Reset</a>
            @endif
        </div>
    </form>

    <form method="GET" action="/catatan" class="ms-2">
        <input type="hidden" name="cari" value="{{ request('cari') }}">
        <select name="urut" class="form-select" onchange="this.form.submit()">
            <option value="terbaru" {{ request('urut') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
            <option value="terlama" {{ request('urut') == 'terlama' ? 'selected' : '' }}>Terlama</option>
        </select>
    </form>
</div>

@if($catatan->count() > 0)
    <div class="row">
        @foreach($catatan as $item)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-1">{{ $item->judul }}</h5>
                        <small class="text-muted">Dibuat pada: {{ $item->created_at->format('d F Y \p\u\k\u\l H.i') }}</small>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ Str::limit($item->isi, 100) }}</p>
                        <a href="/catatan/{{ $item->id }}" class="btn btn-sm btn-outline-primary" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="/catatan/{{ $item->id }}/edit" class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="/catatan/{{ $item->id }}/archive" method="POST" class="d-inline" title="Arsipkan">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary"
                                    onclick="return confirm('Arsipkan catatan ini?')">
                                <i class="fas fa-archive"></i>
                            </button>
                        </form>
                        <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                onclick="bukaModalHapus('/catatan/{{ $item->id }}', '{{ addslashes($item->judul) }}')">
                            <i class="fas fa-trash"></i>
                        </button>
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

{{ $catatan->links('pagination::bootstrap-5') }}
@endsection