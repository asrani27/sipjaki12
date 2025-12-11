<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\BeritaController;

Route::get('/', [PortalController::class, 'welcome']);
Route::get('/welcome2', [PortalController::class, 'welcome2']);

// Portal Routes (public access)
Route::controller(PortalController::class)->group(function () {
    Route::get('/beranda', 'beranda')->name('beranda');
    Route::get('/profil', 'profil')->name('profil');
    Route::get('/struktur-organisasi', 'strukturOrganisasi')->name('struktur-organisasi');
    Route::get('/renstra', 'renstra')->name('renstra');
    Route::get('/tupoksi', 'tupoksi')->name('tupoksi');
    Route::get('/informasi', 'informasi')->name('informasi');
    Route::get('/berita', 'berita')->name('berita');
    Route::get('/agenda', 'agenda')->name('agenda');
    Route::get('/pelatihan', 'pelatihan')->name('pelatihan');
    Route::get('/sertifikasi', 'sertifikasi')->name('sertifikasi');
    Route::get('/bimtek', 'bimtek')->name('bimtek');
    Route::get('/pengawasan', 'pengawasan')->name('pengawasan');
    Route::get('/tertib-usaha', 'tertibUsaha')->name('tertib-usaha');
    Route::get('/tertib-penyelenggara', 'tertibPenyelenggara')->name('tertib-penyelenggara');
    Route::get('/tertib-pemanfaatan', 'tertibPemanfaatan')->name('tertib-pemanfaatan');
    Route::get('/jakon', 'jakon')->name('jakon');
    Route::get('/ska-skt', 'skaSkt')->name('ska-skt');
    Route::get('/penanggung-jawab-teknik', 'penanggungJawabTeknik')->name('penanggung-jawab-teknik');
    Route::get('/tim-pembina', 'timPembina')->name('tim-pembina');
    Route::get('/spm', 'spm')->name('spm');
    Route::get('/spm-informasi', 'spmInformasi')->name('spm-informasi');
    Route::get('/spm-laporan', 'spmLaporan')->name('spm-laporan');
    Route::get('/potensi-pasar', 'potensiPasar')->name('potensi-pasar');
    Route::get('/peraturan', 'peraturan')->name('peraturan');
});

// Berita Detail Route (public access)
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function () {
    return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
})->name('password.email');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('dashboard');

    // Superadmin Routes
    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::prefix('profil')->name('profil.')->group(function () {
            Route::get('/struktur/edit', [SuperadminController::class, 'editStruktur'])->name('struktur.edit');
            Route::put('/struktur/update', [SuperadminController::class, 'updateStruktur'])->name('struktur.update');
            Route::get('/renstra/edit', [SuperadminController::class, 'editRenstra'])->name('renstra.edit');
            Route::put('/renstra/update', [SuperadminController::class, 'updateRenstra'])->name('renstra.update');
            Route::get('/tupoksi/edit', [SuperadminController::class, 'editTupoksi'])->name('tupoksi.edit');
            Route::put('/tupoksi/update', [SuperadminController::class, 'updateTupoksi'])->name('tupoksi.update');
        });

        // Image upload route for Summernote
        Route::post('/upload-image', [SuperadminController::class, 'uploadImage'])->name('upload.image');

        // Berita Routes
        Route::resource('berita', BeritaController::class)->parameters([
            'berita' => 'berita'
        ]);

        // Agenda Routes
        Route::resource('agenda', AgendaController::class);

        // Slideshow Routes
        Route::resource('slideshow', SlideController::class)->parameters([
            'slideshow' => 'slide'
        ]);
    });
});
