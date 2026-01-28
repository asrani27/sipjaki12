<?php

namespace App\Http\Controllers;

use App\Models\Peraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $fileName = 'peraturan-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('sipjaki', $file, $fileName);
            $data['file'] = basename($path);
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
            // Hapus file lama dari S3
            if ($peraturan->file) {
                Storage::disk('s3')->delete('sipjaki/' . $peraturan->file);
            }

            // Upload file baru ke S3
            $file = $request->file('file');
            $fileName = 'peraturan-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('sipjaki', $file, $fileName);
            $data['file'] = basename($path);
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
        // Hapus file dari S3 jika ada
        if ($peraturan->file) {
            Storage::disk('s3')->delete('sipjaki/' . $peraturan->file);
        }

        $peraturan->delete();

        return redirect()->route('superadmin.peraturan.index')
            ->with('success', 'Peraturan berhasil dihapus.');
    }
}
