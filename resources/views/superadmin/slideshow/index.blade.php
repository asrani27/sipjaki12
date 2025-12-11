@extends('layouts.app')

@section('title', 'Manajemen Slideshow')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Slideshow</h1>
        <p class="text-gray-600 mt-1">Kelola gambar-gambar untuk slideshow halaman utama</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add Button -->
    <div class="mb-6">
        <a href="{{ route('superadmin.slideshow.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Slide Baru
        </a>
    </div>

    <!-- Slides Grid -->
    @if($slides->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($slides as $slide)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Image Preview -->
                    <div class="aspect-video bg-gray-100 relative">
                        <img src="{{ asset('storage/' . $slide->file) }}" 
                             alt="Slide {{ $slide->id }}" 
                             class="w-full h-full object-cover">
                        
                        <!-- Delete Button -->
                        <form action="{{ route('superadmin.slideshow.destroy', $slide) }}" 
                              method="POST" 
                              class="absolute top-2 right-2"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus slide ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Slide Info -->
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-900">Slide #{{ $slide->id }}</span>
                            <span class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($slide->created_at)->format('d M Y') }}
                            </span>
                        </div>
                        
                        <!-- File Info -->
                        <div class="mt-2 text-xs text-gray-500">
                            @php
                                $filePath = storage_path('app/public/' . $slide->file);
                                if (file_exists($filePath)) {
                                    $fileSize = filesize($filePath);
                                    $fileSizeFormatted = number_format($fileSize / 1024, 2) . ' KB';
                                } else {
                                    $fileSizeFormatted = 'N/A';
                                }
                            @endphp
                            Ukuran: {{ $fileSizeFormatted }}
                        </div>
                        
                        <!-- Full Path -->
                        <div class="mt-1 text-xs text-gray-400 truncate" title="{{ $slide->file }}">
                            {{ $slide->file }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada slide</h3>
            <p class="text-gray-500 mb-6">Mulai dengan menambahkan slide pertama untuk slideshow Anda.</p>
            <a href="{{ route('superadmin.slideshow.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Slide Baru
            </a>
        </div>
    @endif

    <!-- Instructions -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h4 class="font-medium text-blue-900 mb-2">Petunjuk:</h4>
        <ul class="text-sm text-blue-800 space-y-1">
            <li>• Format file yang didukung: JPEG, PNG, JPG, GIF</li>
            <li>• Ukuran maksimal file: 2MB</li>
            <li>• Disarankan menggunakan gambar dengan rasio aspek 16:9 untuk hasil terbaik</li>
            <li>• Slide akan ditampilkan berdasarkan urutan pembuatan (terbaru dulu)</li>
        </ul>
    </div>
</div>
@endsection
