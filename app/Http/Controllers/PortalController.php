<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Berita;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    /**
     * Display the welcome page with berita data.
     */
    public function welcome()
    {
        $berita = Berita::latest()->take(4)->get();
        return view('welcome', compact('berita'));
    }

    /**
     * Display the beranda page.
     */
    public function beranda()
    {
        return view('portal.beranda');
    }

    /**
     * Display the profil page.
     */
    public function profil()
    {
        return view('portal.profil');
    }

    /**
     * Display the struktur organisasi page.
     */
    public function strukturOrganisasi()
    {
        $struktur = Profil::where('jenis', 'struktur')->first();
        return view('portal.struktur-organisasi', compact('struktur'));
    }

    /**
     * Display the renstra page.
     */
    public function renstra()
    {
        $renstra = Profil::where('jenis', 'renstra')->first();
        return view('portal.renstra', compact('renstra'));
    }

    /**
     * Display the tupoksi page.
     */
    public function tupoksi()
    {
        $tupoksi = Profil::where('jenis', 'tupoksi')->first();
        return view('portal.tupoksi', compact('tupoksi'));
    }

    /**
     * Display the informasi page.
     */
    public function informasi()
    {
        return view('portal.informasi');
    }

    /**
     * Display the berita page.
     */
    public function berita()
    {
        return view('portal.berita');
    }

    /**
     * Display the agenda page.
     */
    public function agenda()
    {
        return view('portal.agenda');
    }

    /**
     * Display the pelatihan page.
     */
    public function pelatihan()
    {
        return view('portal.pelatihan');
    }

    /**
     * Display the sertifikasi page.
     */
    public function sertifikasi()
    {
        return view('portal.sertifikasi');
    }

    /**
     * Display the bimtek page.
     */
    public function bimtek()
    {
        return view('portal.bimtek');
    }

    /**
     * Display the pengawasan page.
     */
    public function pengawasan()
    {
        return view('portal.pengawasan');
    }

    /**
     * Display the tertib usaha page.
     */
    public function tertibUsaha()
    {
        return view('portal.tertib-usaha');
    }

    /**
     * Display the tertib penyelenggara page.
     */
    public function tertibPenyelenggara()
    {
        return view('portal.tertib-penyelenggara');
    }

    /**
     * Display the tertib pemanfaatan page.
     */
    public function tertibPemanfaatan()
    {
        return view('portal.tertib-pemanfaatan');
    }

    /**
     * Display the jakon page.
     */
    public function jakon()
    {
        return view('portal.jakon');
    }

    /**
     * Display the SKA/SKT page.
     */
    public function skaSkt()
    {
        return view('portal.ska-skt');
    }

    /**
     * Display the penanggung jawab teknik page.
     */
    public function penanggungJawabTeknik()
    {
        return view('portal.penanggung-jawab-teknik');
    }

    /**
     * Display the tim pembina page.
     */
    public function timPembina()
    {
        return view('portal.tim-pembina');
    }

    /**
     * Display the SPM page.
     */
    public function spm()
    {
        return view('portal.spm');
    }

    /**
     * Display the SPM informasi page.
     */
    public function spmInformasi()
    {
        return view('portal.spm-informasi');
    }

    /**
     * Display the SPM laporan page.
     */
    public function spmLaporan()
    {
        return view('portal.spm-laporan');
    }

    /**
     * Display the potensi pasar page.
     */
    public function potensiPasar()
    {
        return view('portal.potensi-pasar');
    }

    /**
     * Display the peraturan page.
     */
    public function peraturan()
    {
        return view('portal.peraturan');
    }
}
