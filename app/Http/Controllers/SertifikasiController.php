<?php

namespace App\Http\Controllers;

use App\Models\Sertifikasi;
use Illuminate\Http\Request;

class SertifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sertifikasi = Sertifikasi::latest()->paginate(10);
        return view('superadmin.sertifikasi.index', compact('sertifikasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.sertifikasi.create');
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
            'jenjang_klasifikasi' => 'nullable|string|max:255',
            'jenjang_kualifikasi' => 'nullable|string|max:255',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'selesai' => 'required|date',
            'jam' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Sertifikasi::create($request->all());

        return redirect()->route('superadmin.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sertifikasi $sertifikasi)
    {
        return view('superadmin.sertifikasi.edit', compact('sertifikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sertifikasi $sertifikasi)
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
            'jenjang_klasifikasi' => 'nullable|string|max:255',
            'jenjang_kualifikasi' => 'nullable|string|max:255',
            'nomor_sertifikat' => 'nullable|string|max:255',
            'selesai' => 'required|date',
            'jam' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $sertifikasi->update($request->all());

        return redirect()->route('superadmin.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sertifikasi $sertifikasi)
    {
        $sertifikasi->delete();

        return redirect()->route('superadmin.sertifikasi.index')
            ->with('success', 'Sertifikasi berhasil dihapus.');
    }
}
