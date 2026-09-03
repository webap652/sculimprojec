<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('urutan')->orderBy('nama')->get();
        $kategoriList = Fasilitas::kategoriList();
        return view('admin.fasilitas.index', compact('fasilitas', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = Fasilitas::kategoriList();
        return view('admin.fasilitas.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Tidak Ada',
            'kategori' => 'required|in:' . implode(',', array_keys(Fasilitas::kategoriList())),
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'fasilitas-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('fasilitas', $filename, 'public');
            $data['foto'] = 'fasilitas/' . $filename;
        }

        Fasilitas::create($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        $kategoriList = Fasilitas::kategoriList();
        return view('admin.fasilitas.edit', compact('fasilitas', 'kategoriList'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Tidak Ada',
            'kategori' => 'required|in:' . implode(',', array_keys(Fasilitas::kategoriList())),
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'fasilitas-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('fasilitas', $filename, 'public');
            $data['foto'] = 'fasilitas/' . $filename;
        }

        $fasilitas->update($data);
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}

