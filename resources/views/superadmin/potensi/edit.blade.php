@extends('layouts.app')

@section('title', 'Edit Potensi Pasar')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Potensi Pasar</h1>
        <p class="text-gray-600">Ubah informasi potensi pasar</p>
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
                    <a href="{{ route('superadmin.potensi.index') }}" class="text-gray-700 hover:text-gray-900">
                        Potensi Pasar
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
            <form method="POST" action="{{ route('superadmin.potensi.update', $potensi) }}">
                @csrf
                @method('PUT')

                <!-- Form Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tahun -->
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tahun" id="tahun"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('tahun', $potensi->tahun) }}" placeholder="Contoh: 2024" required>
                        @error('tahun')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sumber Dana -->
                    <div>
                        <label for="sumber_dana" class="block text-sm font-medium text-gray-700 mb-2">
                            Sumber Dana <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="sumber_dana" id="sumber_dana"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('sumber_dana', $potensi->sumber_dana) }}" placeholder="Contoh: APBD" required>
                        @error('sumber_dana')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Besar Anggaran -->
                    <div>
                        <label for="besar_anggaran" class="block text-sm font-medium text-gray-700 mb-2">
                            Besar Anggaran <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="besar_anggaran" id="besar_anggaran" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('besar_anggaran', $potensi->besar_anggaran) }}"
                            placeholder="Masukkan nilai anggaran" required>
                        @error('besar_anggaran')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penanggung Jawab -->
                    <div>
                        <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">
                            Penanggung Jawab <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('penanggung_jawab', $potensi->penanggung_jawab) }}"
                            placeholder="Masukkan nama penanggung jawab" required>
                        @error('penanggung_jawab')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Infrastruktur -->
                <div class="mb-6">
                    <label for="infrastruktur" class="block text-sm font-medium text-gray-700 mb-2">
                        Infrastruktur
                    </label>
                    <textarea name="infrastruktur" id="infrastruktur" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan deskripsi infrastruktur (opsional)">{{ old('infrastruktur', $potensi->infrastruktur) }}</textarea>
                    @error('infrastruktur')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Layanan -->
                <div class="mb-6">
                    <label for="layanan" class="block text-sm font-medium text-gray-700 mb-2">
                        Layanan
                    </label>
                    <textarea name="layanan" id="layanan" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan deskripsi layanan (opsional)">{{ old('layanan', $potensi->layanan) }}</textarea>
                    @error('layanan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('superadmin.potensi.index') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="space-x-3">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection