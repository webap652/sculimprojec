<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::orderBy('urutan')->orderBy('nama_lengkap')->get();
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'nullable|string|max:30',
            'mapel' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'status' => 'required|in:ASN,Honorer,PPPk,Tetap Yayasan',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jabatan' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'guru-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('guru', $filename, 'public');
            $data['foto'] = 'guru/' . $filename;
        }

        Guru::create($data);
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nip' => 'nullable|string|max:30',
            'mapel' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'status' => 'required|in:ASN,Honorer,PPPk,Tetap Yayasan',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'jabatan' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'guru-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('guru', $filename, 'public');
            $data['foto'] = 'guru/' . $filename;
        }

        $guru->update($data);
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }

    public function toggle(Guru $guru)
    {
        $guru->update(['is_active' => !$guru->is_active]);
        return redirect()->route('admin.guru.index')->with('success', 'Status guru berhasil diubah.');
    }
}

