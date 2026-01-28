<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peraturan = Peraturan::latest()->paginate(10);
        return view('superadmin.peraturan.index', compact('peraturan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.peraturan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'kategori' => 'required|in:UNDANG-UNDANG,PERATURAN PEMERINTAH,PERATURAN PRESIDEN,PERATURAN MENTERI,KEPUTUSAN MENTERI,SURAT EDARAN MENTERI,REFERENSI,PERATURAN DAERAH,PERATURAN GUBERNUR,PERATURAN WALIKOTA,SURAT KEPUTUSAN',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/peraturan'), $fileName);
            $data['file'] = $fileName;
        }

        Peraturan::create($data);

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peraturan $peraturan)
    {
        return view('superadmin.peraturan.edit', compact('peraturan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peraturan $peraturan)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'kategori' => 'required|in:UNDANG-UNDANG,PERATURAN PEMERINTAH,PERATURAN PRESIDEN,PERATURAN MENTERI,KEPUTUSAN MENTERI,SURAT EDARAN MENTERI,REFERENSI,PERATURAN DAERAH,PERATURAN GUBERNUR,PERATURAN WALIKOTA,SURAT KEPUTUSAN',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($peraturan->file && file_exists(public_path('uploads/peraturan/' . $peraturan->file))) {
                unlink(public_path('uploads/peraturan/' . $peraturan->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/peraturan'), $fileName);
            $data['file'] = $fileName;
        }

        $peraturan->update($data);

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peraturan $peraturan)
    {
        // Delete file if exists
        if ($peraturan->file && file_exists(public_path('uploads/peraturan/' . $peraturan->file))) {
            unlink(public_path('uploads/peraturan/' . $peraturan->file));
        }

        $peraturan->delete();

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil dihapus.');
    }
}