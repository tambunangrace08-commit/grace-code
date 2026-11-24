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
    $request->validate([
        'judul' => 'required|max:255',
        'isi'   => 'required',
    ]);

    Catatan::create($request->only(['judul', 'isi']));

    return redirect('/catatan')->with('sukses', 'Catatan berhasil disimpan!');
}

    public function edit(Catatan $catatan)
    {
        return view('catatan.edit', compact('catatan'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|max:255',
        'isi'   => 'required',
    ]);

    $catatan = Catatan::findOrFail($id);
    $catatan->update($request->only(['judul', 'isi']));

    return redirect("/catatan/{$id}")->with('sukses', 'Catatan berhasil diperbarui!');
}

    public function destroy(Catatan $catatan)
    {
        $catatan->delete();

        return redirect()->route('catatan.index')->with('sukses', 'Catatan berhasil dihapus!');
    }
}