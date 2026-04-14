@extends('layouts.app')

@section('title', 'Edit Tertib Usaha')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Data Tertib Usaha</h1>
        <p class="text-gray-600">Perbarui data pengawasan tertib usaha</p>
    </div>

    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">
                    <i class="fas fa-home mr-2"></i>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                    <a href="{{ route('superadmin.pengawasan.tertib_usaha.index') }}" class="text-gray-700 hover:text-gray-900">
                        Tertib Usaha
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                    <span class="text-gray-500">Edit</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <form method="POST" action="{{ route('superadmin.pengawasan.tertib_usaha.update', $tertibUsaha) }}">
                @csrf
                @method('PUT')

                <!-- Section: Identitas Badan Usaha -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Identitas Badan Usaha</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama BadanUsaha -->
                        <div>
                            <label for="nama_badan_usaha" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Badan Usaha
                            </label>
                            <input type="text" name="nama_badan_usaha" id="nama_badan_usaha"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('nama_badan_usaha', $tertibUsaha->nama_badan_usaha) }}" placeholder="Masukkan nama badan usaha">
                            @error('nama_badan_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Pimpinan -->
                        <div>
                            <label for="nama_pimpinan" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Pimpinan
                            </label>
                            <input type="text" name="nama_pimpinan" id="nama_pimpinan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('nama_pimpinan', $tertibUsaha->nama_pimpinan) }}" placeholder="Masukkan nama pimpinan">
                            @error('nama_pimpinan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. NIB -->
                        <div>
                            <label for="no_nib" class="block text-sm font-medium text-gray-700 mb-2">
                                No. NIB
                            </label>
                            <input type="text" name="no_nib" id="no_nib"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('no_nib', $tertibUsaha->no_nib) }}" placeholder="Masukkan nomor NIB">
                            @error('no_nib')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. SBU -->
                        <div>
                            <label for="no_sbu" class="block text-sm font-medium text-gray-700 mb-2">
                                No. SBU
                            </label>
                            <input type="text" name="no_sbu" id="no_sbu"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('no_sbu', $tertibUsaha->no_sbu) }}" placeholder="Masukkan nomor SBU">
                            @error('no_sbu')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NPWP -->
                        <div>
                            <label for="npwp" class="block text-sm font-medium text-gray-700 mb-2">
                                NPWP
                            </label>
                            <input type="text" name="npwp" id="npwp"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('npwp', $tertibUsaha->npwp) }}" placeholder="Masukkan NPWP">
                            @error('npwp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. Telp -->
                        <div>
                            <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-2">
                                No. Telepon
                            </label>
                            <input type="text" name="no_telp" id="no_telp"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('no_telp', $tertibUsaha->no_telp) }}" placeholder="Masukkan nomor telepon">
                            @error('no_telp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('email', $tertibUsaha->email) }}" placeholder="Masukkan email">
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div>
                            <label for="instansi" class="block text-sm font-medium text-gray-700 mb-2">
                                Instansi
                            </label>
                            <input type="text" name="instansi" id="instansi"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('instansi', $tertibUsaha->instansi) }}" placeholder="Masukkan nama instansi">
                            @error('instansi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mt-6">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat
                        </label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $tertibUsaha->alamat) }}</textarea>
                        @error('alamat')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Kab/Kota -->
                        <div>
                            <label for="kab_kota" class="block text-sm font-medium text-gray-700 mb-2">
                                Kabupaten/Kota
                            </label>
                            <input type="text" name="kab_kota" id="kab_kota"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('kab_kota', $tertibUsaha->kab_kota) }}" placeholder="Masukkan kabupaten/kota">
                            @error('kab_kota')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provinsi -->
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Provinsi
                            </label>
                            <input type="text" name="provinsi" id="provinsi"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('provinsi', $tertibUsaha->provinsi) }}" placeholder="Masukkan provinsi">
                            @error('provinsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Informasi Usaha -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Usaha</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jenis Usaha -->
                        <div>
                            <label for="jenis_usaha" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Usaha
                            </label>
                            <input type="text" name="jenis_usaha" id="jenis_usaha"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('jenis_usaha', $tertibUsaha->jenis_usaha) }}" placeholder="Masukkan jenis usaha">
                            @error('jenis_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sifat Usaha -->
                        <div>
                            <label for="sifat_usaha" class="block text-sm font-medium text-gray-700 mb-2">
                                Sifat Usaha
                            </label>
                            <input type="text" name="sifat_usaha" id="sifat_usaha"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('sifat_usaha', $tertibUsaha->sifat_usaha) }}" placeholder="Masukkan sifat usaha">
                            @error('sifat_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Klasifikasi Usaha -->
                        <div>
                            <label for="klasifikasi_usaha" class="block text-sm font-medium text-gray-700 mb-2">
                                Klasifikasi Usaha
                            </label>
                            <input type="text" name="klasifikasi_usaha" id="klasifikasi_usaha"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('klasifikasi_usaha', $tertibUsaha->klasifikasi_usaha) }}" placeholder="Masukkan klasifikasi usaha">
                            @error('klasifikasi_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kualifikasi Usaha -->
                        <div>
                            <label for="kualifikasi_usaha" class="block text-sm font-medium text-gray-700 mb-2">
                                Kualifikasi Usaha
                            </label>
                            <input type="text" name="kualifikasi_usaha" id="kualifikasi_usaha"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('kualifikasi_usaha', $tertibUsaha->kualifikasi_usaha) }}" placeholder="Masukkan kualifikasi usaha">
                            @error('kualifikasi_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Layanan Usaha -->
                        <div>
                            <label for="layanan_usaha" class="block text-sm font-medium text-gray-700 mb-2">
                                Layanan Usaha
                            </label>
                            <input type="text" name="layanan_usaha" id="layanan_usaha"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('layanan_usaha', $tertibUsaha->layanan_usaha) }}" placeholder="Masukkan layanan usaha">
                            @error('layanan_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. Reg SBU -->
                        <div>
                            <label for="no_reg_sbu" class="block text-sm font-medium text-gray-700 mb-2">
                                No. Reg SBU
                            </label>
                            <input type="text" name="no_reg_sbu" id="no_reg_sbu"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('no_reg_sbu', $tertibUsaha->no_reg_sbu) }}" placeholder="Masukkan nomor reg SBU">
                            @error('no_reg_sbu')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Masa Berlaku SBU -->
                        <div>
                            <label for="masa_berlaku_sbu" class="block text-sm font-medium text-gray-700 mb-2">
                                Masa Berlaku SBU
                            </label>
                            <input type="date" name="masa_berlaku_sbu" id="masa_berlaku_sbu"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('masa_berlaku_sbu', $tertibUsaha->masa_berlaku_sbu) }}">
                            @error('masa_berlaku_sbu')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status BPJS -->
                        <div>
                            <label for="status_bpjs" class="block text-sm font-medium text-gray-700 mb-2">
                                Status BPJS
                            </label>
                            <input type="text" name="status_bpjs" id="status_bpjs"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('status_bpjs', $tertibUsaha->status_bpjs) }}" placeholder="Masukkan status BPJS">
                            @error('status_bpjs')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Informasi Paket & Survey -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Paket & Survey</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Waktu Survey -->
                        <div>
                            <label for="waktu_survey" class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu Survey
                            </label>
                            <input type="date" name="waktu_survey" id="waktu_survey"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('waktu_survey', $tertibUsaha->waktu_survey) }}">
                            @error('waktu_survey')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Paket -->
                        <div>
                            <label for="nama_paket" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Paket
                            </label>
                            <input type="text" name="nama_paket" id="nama_paket"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('nama_paket', $tertibUsaha->nama_paket) }}" placeholder="Masukkan nama paket">
                            @error('nama_paket')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nilai Kontrak -->
                        <div>
                            <label for="nilai_kontrak" class="block text-sm font-medium text-gray-700 mb-2">
                                Nilai Kontrak
                            </label>
                            <input type="number" name="nilai_kontrak" id="nilai_kontrak"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('nilai_kontrak', $tertibUsaha->nilai_kontrak) }}" placeholder="Masukkan nilai kontrak">
                            @error('nilai_kontrak')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lama Pekerjaan -->
                        <div>
                            <label for="lama_pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                                Lama Pekerjaan
                            </label>
                            <input type="text" name="lama_pekerjaan" id="lama_pekerjaan"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('lama_pekerjaan', $tertibUsaha->lama_pekerjaan) }}" placeholder="Contoh: 120 Hari">
                            @error('lama_pekerjaan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai Kontrak -->
                        <div>
                            <label for="tanggal_mulai_kontrak" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Mulai Kontrak
                            </label>
                            <input type="date" name="tanggal_mulai_kontrak" id="tanggal_mulai_kontrak"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('tanggal_mulai_kontrak', $tertibUsaha->tanggal_mulai_kontrak) }}">
                            @error('tanggal_mulai_kontrak')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Berakhir Kontrak -->
                        <div>
                            <label for="tanggal_berakhit_kontrak" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Berakhir Kontrak
                            </label>
                            <input type="date" name="tanggal_berakhit_kontrak" id="tanggal_berakhit_kontrak"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('tanggal_berakhit_kontrak', $tertibUsaha->tanggal_berakhit_kontrak) }}">
                            @error('tanggal_berakhit_kontrak')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section: Dokumen -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Dokumen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- URL File NIB -->
                        <div>
                            <label for="url_file_nib" class="block text-sm font-medium text-gray-700 mb-2">
                                URL File NIB
                            </label>
                            <input type="url" name="url_file_nib" id="url_file_nib"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('url_file_nib', $tertibUsaha->url_file_nib) }}" placeholder="https://contoh.com/file-nib.pdf">
                            @error('url_file_nib')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL File SBU -->
                        <div>
                            <label for="url_file_sbu" class="block text-sm font-medium text-gray-700 mb-2">
                                URL File SBU
                            </label>
                            <input type="url" name="url_file_sbu" id="url_file_sbu"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('url_file_sbu', $tertibUsaha->url_file_sbu) }}" placeholder="https://contoh.com/file-sbu.pdf">
                            @error('url_file_sbu')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL Kwitansi -->
                        <div>
                            <label for="url_kwitansi" class="block text-sm font-medium text-gray-700 mb-2">
                                URL Kwitansi
                            </label>
                            <input type="url" name="url_kwitansi" id="url_kwitansi"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('url_kwitansi', $tertibUsaha->url_kwitansi) }}" placeholder="https://contoh.com/kwitansi.pdf">
                            @error('url_kwitansi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('superadmin.pengawasan.tertib_usaha.index') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="space-x-3">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
