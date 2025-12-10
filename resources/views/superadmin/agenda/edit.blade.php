@extends('layouts.app')

@section('title', 'Edit Agenda')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Agenda</h1>
        <p class="text-gray-600">Ubah informasi agenda kegiatan</p>
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
                    <a href="{{ route('superadmin.agenda.index') }}" class="text-gray-700 hover:text-gray-900">
                        Agenda
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
            <form method="POST" action="{{ route('superadmin.agenda.update', $agenda) }}">
                @csrf
                @method('PUT')

                <!-- Form Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal" id="tanggal" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('tanggal', $agenda->tanggal) }}" required>
                        @error('tanggal')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu -->
                    <div>
                        <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="waktu" id="waktu" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('waktu', $agenda->waktu) }}" required>
                        @error('waktu')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Acara -->
                    <div>
                        <label for="acara" class="block text-sm font-medium text-gray-700 mb-2">
                            Acara <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="acara" id="acara" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('acara', $agenda->acara) }}" placeholder="Masukkan nama acara" required>
                        @error('acara')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tempat -->
                    <div>
                        <label for="tempat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tempat <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tempat" id="tempat" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ old('tempat', $agenda->tempat) }}" placeholder="Masukkan lokasi/tempat" required>
                        @error('tempat')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Penanggung Jawab -->
                <div class="mb-6">
                    <label for="pj_agenda" class="block text-sm font-medium text-gray-700 mb-2">
                        Penanggung Jawab <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="pj_agenda" id="pj_agenda" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('pj_agenda', $agenda->pj_agenda) }}" placeholder="Masukkan nama penanggung jawab" required>
                    @error('pj_agenda')
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
                        placeholder="Masukkan keterangan tambahan (opsional)">{{ old('keterangan', $agenda->keterangan) }}</textarea>
                    @error('keterangan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('superadmin.agenda.index') }}" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="space-x-3">
                        <button type="reset" 
                            class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            <i class="fas fa-redo mr-2"></i>
                            Reset
                        </button>
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
