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

    public function store(Request $request)
    {
        Catatan::create($request->only(['judul', 'isi']));

        return redirect('/catatan')->with('sukses', 'Catatan berhasil disimpan!');
    }
}