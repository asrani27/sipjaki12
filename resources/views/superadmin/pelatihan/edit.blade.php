@extends('layouts.app')

@section('title', 'Edit Pelatihan')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Pelatihan</h1>
        <p class="text-gray-600">Ubah informasi data pelatihan</p>
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
                    <a href="{{ route('superadmin.pelatihan.index') }}" class="text-gray-700 hover:text-gray-900">
                        Pelatihan
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
            <form method="POST" action="{{ route('superadmin.pelatihan.update', $pelatihan) }}">
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
                            value="{{ old('tahun', $pelatihan->tahun) }}" placeholder="Masukkan tahun pelatihan" required>
                        @error('tahun')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('nama', $pelatihan->nama) }}" placeholder="Masukkan nama pelatihan" required>
                        @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kualifikasi -->
                    <div>
                        <label for="kualifikasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Kualifikasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="kualifikasi" id="kualifikasi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('kualifikasi', $pelatihan->kualifikasi) }}" placeholder="Masukkan kualifikasi" required>
                        @error('kualifikasi')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Klasifikasi -->
                    <div>
                        <label for="klasifikasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Klasifikasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="klasifikasi" id="klasifikasi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('klasifikasi', $pelatihan->klasifikasi) }}" placeholder="Masukkan klasifikasi" required>
                        @error('klasifikasi')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 3 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tanggal Mulai (Waktu) -->
                    <div>
                        <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="waktu" id="waktu"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('waktu', $pelatihan->waktu) }}" required>
                        @error('waktu')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="selesai" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="selesai" id="selesai"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('selesai', $pelatihan->selesai) }}" required>
                        @error('selesai')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 4 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Jam -->
                    <div>
                        <label for="jam" class="block text-sm font-medium text-gray-700 mb-2">
                            Jam <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jam" id="jam"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('jam', $pelatihan->jam) }}" placeholder="Contoh: 09:00 - 16:00" required>
                        @error('jam')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Metode -->
                    <div>
                        <label for="metode" class="block text-sm font-medium text-gray-700 mb-2">
                            Metode <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="metode" id="metode"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('metode', $pelatihan->metode) }}" placeholder="Contoh: Online, Offline" required>
                        @error('metode')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 5 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Lokasi -->
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lokasi" id="lokasi"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('lokasi', $pelatihan->lokasi) }}" placeholder="Masukkan lokasi pelatihan" required>
                        @error('lokasi')
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
                            value="{{ old('sumber_dana', $pelatihan->sumber_dana) }}" placeholder="Masukkan sumber dana" required>
                        @error('sumber_dana')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 6 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Penanggung Jawab -->
                    <div>
                        <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">
                            Penanggung Jawab <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('penanggung_jawab', $pelatihan->penanggung_jawab) }}" placeholder="Masukkan nama penanggung jawab" required>
                        @error('penanggung_jawab')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenjang -->
                    <div>
                        <label for="jenjang" class="block text-sm font-medium text-gray-700 mb-2">
                            Jenjang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jenjang" id="jenjang"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('jenjang', $pelatihan->jenjang) }}" placeholder="Masukkan jenjang" required>
                        @error('jenjang')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sub Klasifikasi -->
                <div class="mb-6">
                    <label for="sub_klasifikasi" class="block text-sm font-medium text-gray-700 mb-2">
                        Sub Klasifikasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sub_klasifikasi" id="sub_klasifikasi"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('sub_klasifikasi', $pelatihan->sub_klasifikasi) }}" placeholder="Masukkan sub klasifikasi" required>
                    @error('sub_klasifikasi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="mb-6">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Keterangan
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan', $pelatihan->keterangan) }}</textarea>
                    @error('keterangan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('superadmin.pelatihan.index') }}"
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