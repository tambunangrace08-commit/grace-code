<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catatan;

class CatatanController extends Controller
{
    public function index()
    {
        $catatan = Catatan::all();

        return view('catatan.index', compact('catatan'));
    }

    public function create()
    {
        return view('catatan.create');
    }

    public function show(Catatan $catatan)
    {
        return view('catatan.show', compact('catatan'));
    }

    public function store(Request $request)
    {
        Catatan::create($request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
        ]));

        return redirect()->route('catatan.index')->with('sukses', 'Catatan berhasil disimpan!');
    }

    public function edit(Catatan $catatan)
    {
        return view('catatan.edit', compact('catatan'));
    }

    public function update(Request $request, Catatan $catatan)
    {
        $catatan->update($request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
        ]));

        return redirect()->route('catatan.index')->with('sukses', 'Catatan berhasil diperbarui!');
    }

    public function destroy(Catatan $catatan)
    {
        $catatan->delete();

        return redirect()->route('catatan.index')->with('sukses', 'Catatan berhasil dihapus!');
    }
}