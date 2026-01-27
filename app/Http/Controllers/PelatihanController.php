<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatihan = Pelatihan::latest()->paginate(10);
        return view('superadmin.pelatihan.index', compact('pelatihan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.pelatihan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kualifikasi' => 'required|string|max:255',
            'klasifikasi' => 'required|string|max:255',
            'waktu' => 'required|date',
            'metode' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'sumber_dana' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'sub_klasifikasi' => 'required|string|max:255',
            'selesai' => 'required|date',
            'jam' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Pelatihan::create($request->all());

        return redirect()->route('superadmin.pelatihan.index')
            ->with('success', 'Pelatihan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelatihan $pelatihan)
    {
        return view('superadmin.pelatihan.edit', compact('pelatihan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelatihan $pelatihan)
    {
        $request->validate([
            'tahun' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kualifikasi' => 'required|string|max:255',
            'klasifikasi' => 'required|string|max:255',
            'waktu' => 'required|date',
            'metode' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'sumber_dana' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
            'sub_klasifikasi' => 'required|string|max:255',
            'selesai' => 'required|date',
            'jam' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $pelatihan->update($request->all());

        return redirect()->route('superadmin.pelatihan.index')
            ->with('success', 'Pelatihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();

        return redirect()->route('superadmin.pelatihan.index')
            ->with('success', 'Pelatihan berhasil dihapus.');
    }
}