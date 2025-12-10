@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center mb-2">
            <a href="{{ route('superadmin.berita.index') }}"
                class="text-gray-600 hover:text-gray-900 mr-3 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Edit Berita</h1>
        </div>
        <p class="text-gray-600 ml-8">Perbarui konten berita yang ada untuk website SIPJAKI</p>
    </div>

    <!-- Form Section -->
    <div class="bg-white shadow-sm rounded-lg">
        <form action="{{ route('superadmin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Judul Field -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Berita <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                                id="judul" name="judul" value="{{ old('judul', $berita->judul) }}"
                                placeholder="Masukkan judul berita" required>
                            @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Isi Berita Field -->
                        <div>
                            <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                                Isi Berita <span class="text-red-500">*</span>
                            </label>
                            <textarea name="isi" id="isi" required>{{ old('isi', $berita->isi) }}</textarea>
                            @error('isi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Gambar Upload -->
                        <div>
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                                Ganti Gambar
                            </label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-gray-400 transition-colors">
                                <input type="file" class="hidden @error('gambar') border-red-500 @enderror" id="gambar"
                                    name="gambar" accept="image/*" onchange="previewImage(this)">
                                <label for="gambar" class="cursor-pointer text-center">
                                    <div class="text-gray-500">
                                        <i class="fas fa-cloud-upload-alt text-3xl mb-2 block"></i>
                                        <p class="text-sm">Klik untuk mengganti gambar</p>
                                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah.
                                            Maksimal 2MB. Format: JPEG, PNG, JPG, GIF
                                        </p>
                                    </div>
                                </label>
                            </div>
                            @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($berita->gambar)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                                <img src="{{ asset('storage/berita/gambar/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}" class="w-full h-48 object-cover rounded-lg shadow-sm">
                            </div>
                            @endif
                        </div>

                        <!-- Preview Card -->
                        <div class="bg-gray-50 rounded-lg">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h6 class="text-sm font-medium text-gray-900">Preview Gambar Baru</h6>
                            </div>
                            <div class="p-4 text-center">
                                <div id="imagePreview" class="text-gray-400">
                                    @if($berita->gambar)
                                    <img src="{{ asset('gambar/' . $berita->gambar) }}" alt="Current"
                                        class="w-full h-48 object-cover rounded-lg shadow-sm">
                                    <p class="mt-2 text-sm text-gray-500">Gambar saat ini (atau preview gambar baru)</p>
                                    @else
                                    <i class="fas fa-image text-4xl mb-2 block"></i>
                                    <p class="text-sm">Belum ada gambar</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <a href="{{ route('superadmin.berita.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Update Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Summernote CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- Global image preview function -->
<script>
    // Define previewImage function globally before DOM is ready
window.previewImage = function(input) {
    const file = input.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" class="w-full h-48 object-cover rounded-lg shadow-sm">
            `;
        }
        reader.readAsDataURL(file);
    } else {
        // Reset to original image
        @if($berita->gambar)
            preview.innerHTML = `
                <img src="{{ asset('gambar/' . $berita->gambar) }}" alt="Current" 
                     class="w-full h-48 object-cover rounded-lg shadow-sm">
                <p class="mt-2 text-sm text-gray-500">Gambar saat ini (atau preview gambar baru)</p>
            `;
        @else
            preview.innerHTML = `
                <i class="fas fa-image text-4xl mb-2 block"></i>
                <p class="text-sm">Belum ada gambar</p>
            `;
        @endif
    }
};

// Initialize Summernote when DOM is ready
$(document).ready(function() {
    $('#isi').summernote({
        height: 300,
        placeholder: 'Masukkan isi berita...',
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
@endpush