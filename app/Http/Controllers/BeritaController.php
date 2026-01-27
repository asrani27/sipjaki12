<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::latest()->paginate(10);
        return view('superadmin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['gambar']);
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar =  'berita-' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('sipjaki', $gambar, $namaGambar);
            $data['gambar'] = basename($path);
        }

        Berita::create($data);

        return redirect()->route('superadmin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('superadmin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['gambar']);
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari S3
            if ($berita->gambar) {
                Storage::disk('s3')->delete('sipjaki/' . $berita->gambar);
            }

            // Upload gambar baru ke S3
            $gambar = $request->file('gambar');
            $namaGambar = 'berita-' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            $path = Storage::disk('s3')->putFileAs('sipjaki', $gambar, $namaGambar);
            $data['gambar'] = basename($path);
        }

        $berita->update($data);

        return redirect()->route('superadmin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        return view('portal.berita-detail', compact('berita'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Hapus gambar dari S3 jika ada
        if ($berita->gambar) {
            Storage::disk('s3')->delete('sipjaki/' . $berita->gambar);
        }

        $berita->delete();

        return redirect()->route('superadmin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
