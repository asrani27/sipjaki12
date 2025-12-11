@extends('layouts.app')

@section('title', 'Tambah Slide Baru')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Slide Baru</h1>
        <p class="text-gray-600 mt-1">Upload gambar untuk ditambahkan ke slideshow</p>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('superadmin.slideshow.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Slide
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('superadmin.slideshow.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- File Upload -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Slide <span class="text-red-500">*</span>
                </label>
                
                <!-- Upload Area -->
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                    <input type="file" 
                           id="file" 
                           name="file" 
                           accept="image/jpeg,image/jpg,image/png,image/gif"
                           class="hidden"
                           required>
                    
                    <!-- Upload Icon -->
                    <div id="upload-icon" class="mx-auto w-12 h-12 text-gray-400 mb-3">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                    </div>
                    
                    <!-- Upload Text -->
                    <div id="upload-text">
                        <p class="text-sm text-gray-600 mb-2">
                            Klik untuk memilih gambar atau drag and drop
                        </p>
                        <p class="text-xs text-gray-500">
                            JPEG, PNG, JPG, GIF (Maks. 2MB)
                        </p>
                    </div>
                    
                    <!-- Preview Area -->
                    <div id="preview-area" class="hidden">
                        <img id="preview-image" src="" alt="Preview" class="mx-auto max-h-64 rounded-lg shadow-md mb-3">
                        <p id="file-name" class="text-sm font-medium text-gray-700 mb-2"></p>
                        <button type="button" 
                                id="remove-file"
                                class="text-red-500 hover:text-red-700 text-sm font-medium">
                            Hapus Gambar
                        </button>
                    </div>
                </div>
                
                <p class="mt-2 text-xs text-gray-500">
                    Disarankan menggunakan gambar dengan rasio aspek 16:9 (misalnya 1920x1080px)
                </p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('superadmin.slideshow.index') }}" 
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Slide
                </button>
            </div>
        </form>
    </div>

    <!-- Instructions -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h4 class="font-medium text-blue-900 mb-2">Petunjuk Upload:</h4>
        <ul class="text-sm text-blue-800 space-y-1">
            <li>• Pilih gambar yang berkualitas tinggi dan relevan dengan konten website</li>
            <li>• Pastikan gambar tidak mengandung materi yang melanggar hak cipta</li>
            <li>• Gunakan gambar dengan ukuran file yang wajar untuk optimasi loading</li>
            <li>• Slide akan ditampilkan di halaman utama website</li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file');
    const uploadArea = fileInput.parentElement;
    const uploadIcon = document.getElementById('upload-icon');
    const uploadText = document.getElementById('upload-text');
    const previewArea = document.getElementById('preview-area');
    const previewImage = document.getElementById('preview-image');
    const fileName = document.getElementById('file-name');
    const removeFileBtn = document.getElementById('remove-file');

    // Click to upload
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('border-blue-500', 'bg-blue-50');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('border-blue-500', 'bg-blue-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    // File selection
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            handleFileSelect(this.files[0]);
        }
    });

    // Remove file
    removeFileBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.value = '';
        uploadIcon.classList.remove('hidden');
        uploadText.classList.remove('hidden');
        previewArea.classList.add('hidden');
    });

    // Handle file selection
    function handleFileSelect(file) {
        // Check file type
        if (!file.type.match('image.*')) {
            alert('File yang dipilih bukan gambar. Silakan pilih file gambar.');
            fileInput.value = '';
            return;
        }

        // Check file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal ukuran file adalah 2MB.');
            fileInput.value = '';
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            fileName.textContent = file.name;
            uploadIcon.classList.add('hidden');
            uploadText.classList.add('hidden');
            previewArea.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
