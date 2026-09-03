<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturs = StrukturOrganisasi::with('parent')->orderBy('urutan')->orderBy('nama')->get();
        return view('admin.struktur-organisasi.index', compact('strukturs'));
    }

    public function create()
    {
        $parents = StrukturOrganisasi::aktif()->urut()->get();
        return view('admin.struktur-organisasi.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'struktur-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('struktur-organisasi', $filename, 'public');
            $data['foto'] = 'struktur-organisasi/' . $filename;
        }

        StrukturOrganisasi::create($data);
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Anggota struktur berhasil ditambahkan.');
    }

    public function edit(StrukturOrganisasi $strukturOrganisasi)
    {
        $parents = StrukturOrganisasi::aktif()->urut()->where('id', '!=', $strukturOrganisasi->id)->get();
        return view('admin.struktur-organisasi.edit', compact('strukturOrganisasi', 'parents'));
    }

    public function update(Request $request, StrukturOrganisasi $strukturOrganisasi)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'struktur-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('struktur-organisasi', $filename, 'public');
            $data['foto'] = 'struktur-organisasi/' . $filename;
        }

        $strukturOrganisasi->update($data);
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Anggota struktur berhasil diperbarui.');
    }

    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        $strukturOrganisasi->delete();
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Anggota struktur berhasil dihapus.');
    }

    public function toggle(StrukturOrganisasi $strukturOrganisasi)
    {
        $strukturOrganisasi->update(['is_active' => !$strukturOrganisasi->is_active]);
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Status anggota struktur berhasil diubah.');
    }
}

