<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuperadminController extends Controller
{
    /**
     * Show the form for editing struktur organisasi.
     */
    public function editStruktur()
    {
        $struktur = Profil::where('jenis', 'struktur')->first();
        return view('superadmin.profil.struktur', compact('struktur'));
    }

    /**
     * Update struktur organisasi.
     */
    public function updateStruktur(Request $request)
    {

        $profil = Profil::where('jenis', 'struktur')->first()->update([
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()
            ->route('superadmin.profil.struktur.edit')
            ->with('success', 'Struktur organisasi berhasil diperbarui!');
    }

    /**
     * Show form for editing renstra.
     */
    public function editRenstra()
    {
        $renstra = Profil::where('jenis', 'renstra')->first();
        return view('superadmin.profil.renstra', compact('renstra'));
    }

    /**
     * Update renstra.
     */
    public function updateRenstra(Request $request)
    {
        $profil = Profil::where('jenis', 'renstra')->first();
        if (!$profil) {
            $profil = new Profil();
            $profil->jenis = 'renstra';
        }
        $profil->deskripsi = $request->deskripsi;
        $profil->save();
        
        return redirect()
            ->route('superadmin.profil.renstra.edit')
            ->with('success', 'Renstra berhasil diperbarui!');
    }

    /**
     * Show form for editing tupoksi.
     */
    public function editTupoksi()
    {
        $tupoksi = Profil::where('jenis', 'tupoksi')->first();
        return view('superadmin.profil.tupoksi', compact('tupoksi'));
    }

    /**
     * Update tupoksi.
     */
    public function updateTupoksi(Request $request)
    {
        $profil = Profil::where('jenis', 'tupoksi')->first();
        if (!$profil) {
            $profil = new Profil();
            $profil->jenis = 'tupoksi';
        }
        $profil->deskripsi = $request->deskripsi;
        $profil->save();
        
        return redirect()
            ->route('superadmin.profil.tupoksi.edit')
            ->with('success', 'Tupoksi berhasil diperbarui!');
    }

    /**
     * Handle image upload for Summernote.
     */
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'File harus berformat: jpeg, png, jpg, gif, svg.',
            'file.max' => 'Ukuran file maksimal 2MB.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('file')
            ], 422);
        }

        try {
            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Store file in public/uploads/struktur directory
            $path = $file->storeAs('uploads/struktur', $filename, 'public');

            // Generate public URL
            $url = asset('storage/' . $path);

            return response()->json([
                'url' => $url,
                'message' => 'Gambar berhasil diunggah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengunggah gambar: ' . $e->getMessage()
            ], 500);
        }
    }
}
