<?php

namespace App\Http\Controllers;

use App\Models\TertibUsaha;
use Illuminate\Http\Request;

class TertibUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TertibUsaha::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_badan_usaha', 'like', '%' . $search . '%')
                  ->orWhere('no_nib', 'like', '%' . $search . '%')
                  ->orWhere('no_sbu', 'like', '%' . $search . '%')
                  ->orWhere('nama_paket', 'like', '%' . $search . '%');
            });
        }
        
        $tertibUsaha = $query->latest()->paginate(10);
        return view('superadmin.pengawasan.tertib_usaha.index', compact('tertibUsaha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.pengawasan.tertib_usaha.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'waktu_survey' => 'nullable|date',
            'nama_paket' => 'nullable|string|max:255',
            'no_nib' => 'nullable|string|max:255',
            'no_sbu' => 'nullable|string|max:255',
            'nama_badan_usaha' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kab_kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
            'sifat_usaha' => 'nullable|string|max:255',
            'no_reg_sbu' => 'nullable|string|max:255',
            'masa_berlaku_sbu' => 'nullable|date',
            'klasifikasi_usaha' => 'nullable|string|max:255',
            'kualifikasi_usaha' => 'nullable|string|max:255',
            'layanan_usaha' => 'nullable|string|max:255',
            'url_file_nib' => 'nullable|string|max:500',
            'url_file_sbu' => 'nullable|string|max:500',
            'status_bpjs' => 'nullable|string|max:255',
            'url_kwitansi' => 'nullable|string|max:500',
            'instansi' => 'nullable|string|max:255',
        ]);

        TertibUsaha::create($request->all());

        return redirect()->route('superadmin.pengawasan.tertib_usaha.index')
            ->with('success', 'Data Tertib Usaha berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TertibUsaha $tertibUsaha)
    {
        return view('superadmin.pengawasan.tertib_usaha.show', compact('tertibUsaha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TertibUsaha $tertibUsaha)
    {
        return view('superadmin.pengawasan.tertib_usaha.edit', compact('tertibUsaha'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TertibUsaha $tertibUsaha)
    {
        $request->validate([
            'waktu_survey' => 'nullable|date',
            'nama_paket' => 'nullable|string|max:255',
            'no_nib' => 'nullable|string|max:255',
            'no_sbu' => 'nullable|string|max:255',
            'nama_badan_usaha' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kab_kota' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:255',
            'jenis_usaha' => 'nullable|string|max:255',
            'sifat_usaha' => 'nullable|string|max:255',
            'no_reg_sbu' => 'nullable|string|max:255',
            'masa_berlaku_sbu' => 'nullable|date',
            'klasifikasi_usaha' => 'nullable|string|max:255',
            'kualifikasi_usaha' => 'nullable|string|max:255',
            'layanan_usaha' => 'nullable|string|max:255',
            'url_file_nib' => 'nullable|string|max:500',
            'url_file_sbu' => 'nullable|string|max:500',
            'status_bpjs' => 'nullable|string|max:255',
            'url_kwitansi' => 'nullable|string|max:500',
            'instansi' => 'nullable|string|max:255',
        ]);

        $tertibUsaha->update($request->all());

        return redirect()->route('superadmin.pengawasan.tertib_usaha.index')
            ->with('success', 'Data Tertib Usaha berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TertibUsaha $tertibUsaha)
    {
        $tertibUsaha->delete();

        return redirect()->route('superadmin.pengawasan.tertib_usaha.index')
            ->with('success', 'Data Tertib Usaha berhasil dihapus.');
    }
}
