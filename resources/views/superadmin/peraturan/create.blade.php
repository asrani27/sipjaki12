@extends('layouts.app')

@section('title', 'Tambah Peraturan')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Tambah Peraturan</h1>
        <p class="text-gray-600">Tambahkan peraturan baru</p>
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
                    <a href="{{ route('superadmin.peraturan.index') }}" class="text-gray-700 hover:text-gray-900">
                        Peraturan
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mr-2"></i>
                    <span class="text-gray-500">Tambah</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <form method="POST" action="{{ route('superadmin.peraturan.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Form Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Nomor -->
                    <div>
                        <label for="nomor" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nomor" id="nomor"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('nomor') }}" placeholder="Masukkan nomor peraturan" required>
                        @error('nomor')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tahun" id="tahun"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('tahun') }}" placeholder="Masukkan tahun peraturan" required>
                        @error('tahun')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" id="judul"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('judul') }}" placeholder="Masukkan judul peraturan" required>
                    @error('judul')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div class="mb-6">
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" id="kategori"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kategori</option>
                        <option value="UNDANG-UNDANG" {{ old('kategori') == 'UNDANG-UNDANG' ? 'selected' : '' }}>UNDANG-UNDANG</option>
                        <option value="PERATURAN PEMERINTAH" {{ old('kategori') == 'PERATURAN PEMERINTAH' ? 'selected' : '' }}>PERATURAN PEMERINTAH</option>
                        <option value="PERATURAN PRESIDEN" {{ old('kategori') == 'PERATURAN PRESIDEN' ? 'selected' : '' }}>PERATURAN PRESIDEN</option>
                        <option value="PERATURAN MENTERI" {{ old('kategori') == 'PERATURAN MENTERI' ? 'selected' : '' }}>PERATURAN MENTERI</option>
                        <option value="KEPUTUSAN MENTERI" {{ old('kategori') == 'KEPUTUSAN MENTERI' ? 'selected' : '' }}>KEPUTUSAN MENTERI</option>
                        <option value="SURAT EDARAN MENTERI" {{ old('kategori') == 'SURAT EDARAN MENTERI' ? 'selected' : '' }}>SURAT EDARAN MENTERI</option>
                        <option value="REFERENSI" {{ old('kategori') == 'REFERENSI' ? 'selected' : '' }}>REFERENSI</option>
                        <option value="PERATURAN DAERAH" {{ old('kategori') == 'PERATURAN DAERAH' ? 'selected' : '' }}>PERATURAN DAERAH</option>
                        <option value="PERATURAN GUBERNUR" {{ old('kategori') == 'PERATURAN GUBERNUR' ? 'selected' : '' }}>PERATURAN GUBERNUR</option>
                        <option value="PERATURAN WALIKOTA" {{ old('kategori') == 'PERATURAN WALIKOTA' ? 'selected' : '' }}>PERATURAN WALIKOTA</option>
                        <option value="SURAT KEPUTUSAN" {{ old('kategori') == 'SURAT KEPUTUSAN' ? 'selected' : '' }}>SURAT KEPUTUSAN</option>
                    </select>
                    @error('kategori')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File -->
                <div class="mb-6">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        File (PDF, DOC, DOCX) - Maksimal 10MB
                    </label>
                    <input type="file" name="file" id="file"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        accept=".pdf,.doc,.docx">
                    @error('file')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Format yang diperbolehkan: PDF, DOC, DOCX (Maksimal 10MB)</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('superadmin.peraturan.index') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="space-x-3">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection