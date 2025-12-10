@extends('layouts.app')

@section('title', 'Update Struktur Organisasi - SIPJAKI')

@section('content')
<div class="p-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Struktur Organisasi</h1>
        <p class="text-gray-600">Kelola informasi struktur organisasi SIPJAKI</p>
    </div>

    <!-- Update Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <form method="POST" action="{{ route('superadmin.profil.struktur.update') }}">
                @csrf
                @method('PUT')

                <!-- Hidden field for jenis -->
                <input type="hidden" name="jenis" value="struktur">

                <!-- Form Group -->
                <div class="mb-6">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Struktur Organisasi
                    </label>
                    <textarea name="deskripsi" id="summernote" class="form-control" rows="10"
                        placeholder="Masukkan struktur organisasi...">{{ $struktur->deskripsi ?? '' }}</textarea>
                    @error('deskripsi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="space-x-3">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Section (Optional) -->
    @if($struktur && $struktur->deskripsi)
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview Struktur Organisasi</h3>
            <div class="prose max-w-none">
                {!! $struktur->deskripsi !!}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Summernote CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Summernote
        $('#summernote').summernote({
            height: 400,
            minHeight: 200,
            maxHeight: 800,
            focus: true,
            toolbar: [
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    // Handle image upload if needed
                    for (let i = 0; i < files.length; i++) {
                        sendFile(files[i]);
                    }
                }
            }
        });

        
    });

    // Function to handle file upload
    function sendFile(file) {
        // Create FormData for file upload
        let data = new FormData();
        data.append("file", file);
        data.append("_token", '{{ csrf_token() }}');
        
        $.ajax({
            url: '{{ route("superadmin.upload.image") }}',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(response) {
                if (response.url) {
                    $('#summernote').summernote('insertImage', response.url, file.name);
                }
            },
            error: function(xhr) {
                let errorMessage = 'Gagal mengunggah gambar';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
                alert(errorMessage);
            }
        });
    }

</script>

<style>
    /* Custom Summernote styles */
    .note-editor.note-frame {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
    }

    .note-editor .note-toolbar {
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .note-editor .note-editable {
        min-height: 400px;
    }

    /* Custom prose styles for preview */
    .prose {
        color: #374151;
        line-height: 1.75;
    }

    .prose h1,
    .prose h2,
    .prose h3 {
        color: #111827;
        font-weight: 600;
    }

    .prose ul,
    .prose ol {
        margin-left: 1.5rem;
    }

    .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
    }
</style>
@endsection
