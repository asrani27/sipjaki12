<?php

namespace App\Http\Controllers;

use App\Models\Bimtek;
use Illuminate\Http\Request;

class BimtekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bimtek = Bimtek::latest()->paginate(10);
        return view('superadmin.bimtek.index', compact('bimtek'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.bimtek.create');
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

        Bimtek::create($request->all());

        return redirect()->route('superadmin.bimtek.index')
            ->with('success', 'Bimtek berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bimtek $bimtek)
    {
        return view('superadmin.bimtek.edit', compact('bimtek'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bimtek $bimtek)
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

        $bimtek->update($request->all());

        return redirect()->route('superadmin.bimtek.index')
            ->with('success', 'Bimtek berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bimtek $bimtek)
    {
        $bimtek->delete();

        return redirect()->route('superadmin.bimtek.index')
            ->with('success', 'Bimtek berhasil dihapus.');
    }
}
