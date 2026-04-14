<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\TertibPemanfaatan;
use App\Imports\TertibPemanfaatanImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TertibPemanfaatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TertibPemanfaatan::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_badan_usaha', 'like', '%' . $search . '%')
                    ->orWhere('no_nib', 'like', '%' . $search . '%')
                    ->orWhere('no_sbu', 'like', '%' . $search . '%')
                    ->orWhere('nama_paket', 'like', '%' . $search . '%');
            });
        }

        $tertibPemanfaatan = $query->latest()->paginate(10);
        return view('superadmin.pengawasan.tertib_pemanfaatan.index', compact('tertibPemanfaatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('superadmin.pengawasan.tertib_pemanfaatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'waktu_survey' => 'nullable|date',
            'nama_paket' => 'nullable|string|max:255',
            'nilai_kontrak' => 'nullable|integer',
            'lama_pekerjaan' => 'nullable|string|max:255',
            'tanggal_mulai_kontrak' => 'nullable|date',
            'tanggal_berakhit_kontrak' => 'nullable|date',
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

        TertibPemanfaatan::create($request->all());

        return redirect()->route('superadmin.pengawasan.tertib_pemanfaatan.index')
            ->with('success', 'Data Tertib Pemanfaatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TertibPemanfaatan $tertibPemanfaatan)
    {
        return view('superadmin.pengawasan.tertib_pemanfaatan.show', compact('tertibPemanfaatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TertibPemanfaatan $tertibPemanfaatan)
    {
        return view('superadmin.pengawasan.tertib_pemanfaatan.edit', compact('tertibPemanfaatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TertibPemanfaatan $tertibPemanfaatan)
    {
        $request->validate([
            'waktu_survey' => 'nullable|date',
            'nama_paket' => 'nullable|string|max:255',
            'nilai_kontrak' => 'nullable|integer',
            'lama_pekerjaan' => 'nullable|string|max:255',
            'tanggal_mulai_kontrak' => 'nullable|date',
            'tanggal_berakhit_kontrak' => 'nullable|date',
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

        $tertibPemanfaatan->update($request->all());

        return redirect()->route('superadmin.pengawasan.tertib_pemanfaatan.index')
            ->with('success', 'Data Tertib Pemanfaatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TertibPemanfaatan $tertibPemanfaatan)
    {
        $tertibPemanfaatan->delete();

        return redirect()->route('superadmin.pengawasan.tertib_pemanfaatan.index')
            ->with('success', 'Data Tertib Pemanfaatan berhasil dihapus.');
    }

    /**
     * Import data from Excel file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new TertibPemanfaatanImport, $request->file('file'));
            
            return redirect()->route('superadmin.pengawasan.tertib_pemanfaatan.index')
                ->with('success', 'Data berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('superadmin.pengawasan.tertib_pemanfaatan.index')
                ->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }
}
