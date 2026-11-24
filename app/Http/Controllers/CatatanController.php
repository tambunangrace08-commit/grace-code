<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Catatan;

class CatatanController extends Controller
{
    public function index()
    {
        $catatan = Catatan::where('user_id', auth()->id())
            ->where('is_archived', false)
            ->get();

        return view('catatan.index', compact('catatan'));
    }

    public function create()
    {
        return view('catatan.create');
    }

    public function show($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('catatan.show', compact('catatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|max:255',
            'isi'      => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf,txt|max:2048',
        ]);

        $data = $request->only(['judul', 'isi']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('lampiran', $filename, 'public');
            $data['lampiran'] = $filename;
        }

        Catatan::create($data);

        return redirect('/catatan')->with('sukses', 'Catatan berhasil disimpan!');
    }

    public function edit($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('catatan.edit', compact('catatan'));
    }

    public function update(Request $request, $id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'judul'    => 'required|max:255',
            'isi'      => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf,txt|max:2048',
        ]);

        $data = $request->only(['judul', 'isi']);

        if ($request->hasFile('lampiran')) {
            if ($catatan->lampiran) {
                Storage::disk('public')->delete('lampiran/' . $catatan->lampiran);
            }
            $file = $request->file('lampiran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('lampiran', $filename, 'public');
            $data['lampiran'] = $filename;
        }

        $catatan->update($data);

        return redirect("/catatan/{$catatan->id}")->with('sukses', 'Catatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($catatan->lampiran) {
            Storage::disk('public')->delete('lampiran/' . $catatan->lampiran);
        }

        $catatan->delete();

        return redirect('/catatan')->with('sukses', 'Catatan berhasil dihapus.');
    }

    public function archive($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $catatan->is_archived = true;
        $catatan->save();

        return redirect('/catatan')->with('sukses', 'Catatan telah diarsipkan.');
    }

    public function unarchive($id)
    {
        $catatan = Catatan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $catatan->is_archived = false;
        $catatan->save();

        return redirect('/catatan')->with('sukses', 'Catatan dipulihkan dari arsip.');
    }

    public function arsip()
    {
        $catatan = Catatan::where('user_id', auth()->id())
            ->where('is_archived', true)
            ->get();

        return view('catatan.arsip', compact('catatan'));
    }
}