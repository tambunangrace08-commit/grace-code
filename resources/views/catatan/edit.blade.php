@extends('layouts.app')

@section('title', 'Edit Catatan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Edit Catatan</div>
            <div class="card-body">
                <form method="POST" action="{{ route('catatan.update', $catatan) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $catatan->judul) }}" required>
                        @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Catatan</label>
                        <textarea name="isi" id="isi" class="form-control" rows="5" required>{{ old('isi', $catatan->isi) }}</textarea>
                        @error('isi') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                    <a href="{{ route('catatan.index') }}" class="mt-2 d-block text-center">&larr; Kembali ke Daftar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
