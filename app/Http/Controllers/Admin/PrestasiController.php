<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::latest()->get();
        $kategoriList = Prestasi::kategoriList();
        $tingkatList = Prestasi::tingkatList();
        return view('admin.prestasi.index', compact('prestasis', 'kategoriList', 'tingkatList'));
    }

    public function create()
    {
        $kategoriList = Prestasi::kategoriList();
        $tingkatList = Prestasi::tingkatList();
        return view('admin.prestasi.create', compact('kategoriList', 'tingkatList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'tingkat' => 'required|in:' . implode(',', array_keys(Prestasi::tingkatList())),
            'juara' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:' . implode(',', array_keys(Prestasi::kategoriList())),
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'prestasi-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('prestasi', $filename, 'public');
            $data['foto'] = 'prestasi/' . $filename;
        }

        Prestasi::create($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi)
    {
        $kategoriList = Prestasi::kategoriList();
        $tingkatList = Prestasi::tingkatList();
        return view('admin.prestasi.edit', compact('prestasi', 'kategoriList', 'tingkatList'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $request->validate([
            'nama_prestasi' => 'required|string|max:255',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'tingkat' => 'required|in:' . implode(',', array_keys(Prestasi::tingkatList())),
            'juara' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:' . implode(',', array_keys(Prestasi::kategoriList())),
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'prestasi-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('prestasi', $filename, 'public');
            $data['foto'] = 'prestasi/' . $filename;
        }

        $prestasi->update($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}

