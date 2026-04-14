@extends('layouts.app')

@section('title', 'Detail Tertib Penyelenggara')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Data Tertib Penyelenggara</h1>
        <p class="text-gray-600">Lihat detail data pengawasan tertib penyelenggara</p>
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
                    <a href="{{ route('superadmin.pengawasan.tertib_penyelenggara.index') }}"
                        class="text-gray-700 hover:text-gray-900">
                        Tertib Penyelenggara
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                    <span class="text-gray-500">Detail</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Action Buttons -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('superadmin.pengawasan.tertib_penyelenggara.index') }}"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
        <div class="flex items-center space-x-3">
            <a href="{{ route('superadmin.pengawasan.tertib_penyelenggara.edit', $tertibPenyelenggara) }}"
                class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span>Edit</span>
            </a>
            <form action="{{ route('superadmin.pengawasan.tertib_penyelenggara.destroy', $tertibPenyelenggara) }}"
                method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center space-x-2">
                    <i class="fas fa-trash"></i>
                    <span>Hapus</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <!-- Section: Identitas Badan Usaha -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Identitas Badan Usaha</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Badan Usaha</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->nama_badan_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Pimpinan</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->nama_pimpinan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. NIB</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->no_nib ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. SBU</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->no_sbu ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">NPWP</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->npwp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. Telepon</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->no_telp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->email ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Instansi</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->instansi ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Kabupaten/Kota</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->kab_kota ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Provinsi</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->provinsi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Informasi Usaha -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Usaha</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Usaha</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->jenis_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Sifat Usaha</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->sifat_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Klasifikasi Usaha</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->klasifikasi_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Kualifikasi Usaha</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->kualifikasi_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Layanan Usaha</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->layanan_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. Reg SBU</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->no_reg_sbu ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Masa Berlaku SBU</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->masa_berlaku_sbu ?
                            \Carbon\Carbon::parse($tertibPenyelenggara->masa_berlaku_sbu)->format('d-m-Y') : '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status BPJS</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->status_bpjs ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Informasi Paket & Survey -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Paket & Survey</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Waktu Survey</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->waktu_survey ?
                            \Carbon\Carbon::parse($tertibPenyelenggara->waktu_survey)->format('d-m-Y') : '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Paket</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->nama_paket ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nilai Kontrak</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->nilai_kontrak ? 'Rp ' .
                            number_format($tertibPenyelenggara->nilai_kontrak, 0, ',', '.') : '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Lama Pekerjaan</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->lama_pekerjaan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Mulai Kontrak</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->tanggal_mulai_kontrak ?
                            \Carbon\Carbon::parse($tertibPenyelenggara->tanggal_mulai_kontrak)->format('d-m-Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Berakhir Kontrak</label>
                        <p class="text-gray-900">{{ $tertibPenyelenggara->tanggal_berakhit_kontrak ?
                            \Carbon\Carbon::parse($tertibPenyelenggara->tanggal_berakhit_kontrak)->format('d-m-Y') : '-'
                            }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Dokumen -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Dokumen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">URL File NIB</label>
                        @if($tertibPenyelenggara->url_file_nib)
                        <a href="{{ $tertibPenyelenggara->url_file_nib }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800 underline">{{ $tertibPenyelenggara->url_file_nib
                            }}</a>
                        @else
                        <p class="text-gray-900">-</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">URL File SBU</label>
                        @if($tertibPenyelenggara->url_file_sbu)
                        <a href="{{ $tertibPenyelenggara->url_file_sbu }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800 underline">{{ $tertibPenyelenggara->url_file_sbu
                            }}</a>
                        @else
                        <p class="text-gray-900">-</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">URL Kwitansi</label>
                        @if($tertibPenyelenggara->url_kwitansi)
                        <a href="{{ $tertibPenyelenggara->url_kwitansi }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800 underline">{{ $tertibPenyelenggara->url_kwitansi
                            }}</a>
                        @else
                        <p class="text-gray-900">-</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="text-sm text-gray-500 border-t pt-4">
                <p> Dibuat: {{ $tertibPenyelenggara->created_at ?
                    \Carbon\Carbon::parse($tertibPenyelenggara->created_at)->format('d-m-Y H:i:s') : '-' }}</p>
                <p> Diperbarui: {{ $tertibPenyelenggara->updated_at ?
                    \Carbon\Carbon::parse($tertibPenyelenggara->updated_at)->format('d-m-Y H:i:s') : '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection