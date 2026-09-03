<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarahs = Sejarah::orderBy('tahun')->orderBy('urutan')->get();
        return view('admin.sejarah.index', compact('sejarahs'));
    }

    public function create()
    {
        return view('admin.sejarah.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'urutan' => 'nullable|integer|min:0',
        ]);

        Sejarah::create($data);
        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil ditambahkan.');
    }

    public function edit(Sejarah $sejarah)
    {
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'urutan' => 'nullable|integer|min:0',
        ]);

        $sejarah->update($data);
        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil diperbarui.');
    }

    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();
        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil dihapus.');
    }
}

