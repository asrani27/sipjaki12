@extends('layouts.app')

@section('title', 'Detail Tertib Usaha')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Tertib Usaha</h1>
        <p class="text-gray-600">Lihat detail data pengawasan tertib usaha</p>
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
                    <span class="text-gray-500">Detail</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Detail Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <!-- Section: Identitas Badan Usaha -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Identitas Badan Usaha</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Badan Usaha</label>
                        <p class="text-gray-900">{{ $tertibUsaha->nama_badan_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Pimpinan</label>
                        <p class="text-gray-900">{{ $tertibUsaha->nama_pimpinan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. NIB</label>
                        <p class="text-gray-900">{{ $tertibUsaha->no_nib ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. SBU</label>
                        <p class="text-gray-900">{{ $tertibUsaha->no_sbu ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">NPWP</label>
                        <p class="text-gray-900">{{ $tertibUsaha->npwp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. Telepon</label>
                        <p class="text-gray-900">{{ $tertibUsaha->no_telp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-gray-900">{{ $tertibUsaha->email ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Instansi</label>
                        <p class="text-gray-900">{{ $tertibUsaha->instansi ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Alamat</label>
                        <p class="text-gray-900">{{ $tertibUsaha->alamat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Kabupaten/Kota</label>
                        <p class="text-gray-900">{{ $tertibUsaha->kab_kota ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Provinsi</label>
                        <p class="text-gray-900">{{ $tertibUsaha->provinsi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Informasi Usaha -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Usaha</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Usaha</label>
                        <p class="text-gray-900">{{ $tertibUsaha->jenis_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Sifat Usaha</label>
                        <p class="text-gray-900">{{ $tertibUsaha->sifat_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Klasifikasi Usaha</label>
                        <p class="text-gray-900">{{ $tertibUsaha->klasifikasi_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Kualifikasi Usaha</label>
                        <p class="text-gray-900">{{ $tertibUsaha->kualifikasi_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Layanan Usaha</label>
                        <p class="text-gray-900">{{ $tertibUsaha->layanan_usaha ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">No. Reg SBU</label>
                        <p class="text-gray-900">{{ $tertibUsaha->no_reg_sbu ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Masa Berlaku SBU</label>
                        <p class="text-gray-900">{{ $tertibUsaha->masa_berlaku_sbu ? \Carbon\Carbon::parse($tertibUsaha->masa_berlaku_sbu)->format('d/m/Y') : '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status BPJS</label>
                        <p class="text-gray-900">{{ $tertibUsaha->status_bpjs ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Informasi Paket & Survey -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Informasi Paket & Survey</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Waktu Survey</label>
                        <p class="text-gray-900">{{ $tertibUsaha->waktu_survey ? \Carbon\Carbon::parse($tertibUsaha->waktu_survey)->format('d/m/Y') : '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nama Paket</label>
                        <p class="text-gray-900">{{ $tertibUsaha->nama_paket ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Section: Dokumen -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Dokumen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">URL File NIB</label>
                        @if($tertibUsaha->url_file_nib)
                        <a href="{{ $tertibUsaha->url_file_nib }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                            <i class="fas fa-external-link-alt mr-1"></i> Lihat File
                        </a>
                        @else
                        <p class="text-gray-900">-</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">URL File SBU</label>
                        @if($tertibUsaha->url_file_sbu)
                        <a href="{{ $tertibUsaha->url_file_sbu }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                            <i class="fas fa-external-link-alt mr-1"></i> Lihat File
                        </a>
                        @else
                        <p class="text-gray-900">-</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">URL Kwitansi</label>
                        @if($tertibUsaha->url_kwitansi)
                        <a href="{{ $tertibUsaha->url_kwitansi }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                            <i class="fas fa-external-link-alt mr-1"></i> Lihat File
                        </a>
                        @else
                        <p class="text-gray-900">-</p>
                        @endif
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
                    <a href="{{ route('superadmin.pengawasan.tertib_usaha.edit', $tertibUsaha) }}"
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors flex items-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
