@extends('portal.app')

@section('title', 'Struktur Organisasi - SIPJAKI')

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Struktur Organisasi</h1>

    @if($struktur && $struktur->deskripsi)
    <div class="prose max-w-none p-6">
        {!! $struktur->deskripsi !!}
    </div>
    @else
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="text-lg font-medium text-yellow-800">Belum Ada Data</h3>
                <p class="text-yellow-600 mt-1">Struktur organisasi belum tersedia. Silakan hubungi administrator untuk
                    mengisi konten ini.</p>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    /* Custom prose styles for better content display */
    .prose {
        color: #374151;
        line-height: 1.75;
    }

    .prose h1,
    .prose h2,
    .prose h3,
    .prose h4,
    .prose h5,
    .prose h6 {
        color: #111827;
        font-weight: 600;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
    }

    .prose h1 {
        font-size: 2.25em;
    }

    .prose h2 {
        font-size: 1.875em;
    }

    .prose h3 {
        font-size: 1.5em;
    }

    .prose h4 {
        font-size: 1.25em;
    }

    .prose h5 {
        font-size: 1.125em;
    }

    .prose h6 {
        font-size: 1em;
    }

    .prose p {
        margin-bottom: 1em;
    }

    .prose ul,
    .prose ol {
        margin-left: 1.5rem;
        margin-bottom: 1em;
    }

    .prose li {
        margin-bottom: 0.25em;
    }

    .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1em 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .prose table {
        width: 100%;
        border-collapse: collapse;
        margin: 1em 0;
    }

    .prose th,
    .prose td {
        border: 1px solid #e5e7eb;
        padding: 0.5rem;
        text-align: left;
    }

    .prose th {
        background-color: #f9fafb;
        font-weight: 600;
    }

    .prose blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        margin: 1em 0;
        font-style: italic;
        color: #6b7280;
    }

    .prose a {
        color: #3b82f6;
        text-decoration: none;
    }

    .prose a:hover {
        text-decoration: underline;
    }

    .prose code {
        background-color: #f3f4f6;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875em;
        color: #ef4444;
    }

    .prose pre {
        background-color: #1f2937;
        color: #f9fafb;
        padding: 1rem;
        border-radius: 0.5rem;
        overflow-x: auto;
        margin: 1em 0;
    }

    .prose pre code {
        background-color: transparent;
        color: inherit;
        padding: 0;
    }
</style>
@endsection