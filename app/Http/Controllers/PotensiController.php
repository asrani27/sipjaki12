<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use Illuminate\Http\Request;

class PotensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potensi = Potensi::latest()->paginate(10);
        return view('superadmin.potensi.index', compact('potensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.potensi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:10',
            'sumber_dana' => 'required|string|max:255',
            'besar_anggaran' => 'required|integer|min:0',
            'penanggung_jawab' => 'required|string|max:255',
            'infrastruktur' => 'nullable|string',
            'layanan' => 'nullable|string',
        ]);

        Potensi::create($request->all());

        return redirect()->route('superadmin.potensi.index')
            ->with('success', 'Potensi Pasar berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Potensi $potensi)
    {
        return view('superadmin.potensi.edit', compact('potensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Potensi $potensi)
    {
        $request->validate([
            'tahun' => 'required|string|max:10',
            'sumber_dana' => 'required|string|max:255',
            'besar_anggaran' => 'required|integer|min:0',
            'penanggung_jawab' => 'required|string|max:255',
            'infrastruktur' => 'nullable|string',
            'layanan' => 'nullable|string',
        ]);

        $potensi->update($request->all());

        return redirect()->route('superadmin.potensi.index')
            ->with('success', 'Potensi Pasar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Potensi $potensi)
    {
        $potensi->delete();

        return redirect()->route('superadmin.potensi.index')
            ->with('success', 'Potensi Pasar berhasil dihapus.');
    }
}
