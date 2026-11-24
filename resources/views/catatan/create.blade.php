@extends('layouts.app')

@section('title', 'Tambah Catatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Tambah Catatan Baru</div>
            <div class="card-body">
                <form method="POST" action="/catatan">
                    @csrf
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Catatan</label>
                        <textarea name="isi" id="isi" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                    </div>
                    <a href="/catatan" class="mt-2 d-block text-center">&larr; Kembali ke Daftar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection