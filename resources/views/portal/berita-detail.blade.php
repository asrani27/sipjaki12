@extends('portal.app')

@section('title', $berita->judul . ' - SIPJAKI')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Enhanced Breadcrumb -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('beranda') }}"
                        class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors group">
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        <span class="font-medium">Beranda</span>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('berita') }}"
                            class="ml-1 text-gray-600 hover:text-blue-600 md:ml-2 font-medium transition-colors">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2 font-medium">{{ Str::limit($berita->judul, 50) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Enhanced Article Card -->
        <article
            class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
            @if($berita->gambar)
            <div class="relative h-96 overflow-hidden group">
                <img src="{{ asset('storage/berita/gambar/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                <!-- Category Badge on Image -->
                @if($berita->kategori)
                <div class="absolute top-4 right-4">
                    <span
                        class="px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full text-sm font-bold shadow-lg backdrop-blur-sm">
                        {{ $berita->kategori }}
                    </span>
                </div>
                @endif
            </div>
            @endif

            <div class="p-8 md:p-10">
                <!-- Enhanced Title -->
                <div class="mb-8">
                    <h1
                        class="text-1xl md:text-2xl lg:text-3xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent leading-tight mb-4">
                        {{ $berita->judul }}
                    </h1>

                    <div class="h-1 w-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full"></div>
                </div>

                <!-- Enhanced Meta Information -->
                <div class="flex flex-wrap items-center gap-6 mb-10 pb-8 border-b border-gray-100">
                    <!-- Date with gradient background -->
                    <div class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-purple-50 rounded-full">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700 font-medium">{{ $berita->created_at ? $berita->created_at->format('d
                            F Y') : 'N/A' }}</span>
                    </div>

                    <!-- Author (if available) -->
                    @if($berita->author)
                    <div class="flex items-center px-4 py-2 bg-gradient-to-r from-green-50 to-emerald-50 rounded-full">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700 font-medium">{{ $berita->author }}</span>
                    </div>
                    @endif

                    <!-- Reading Time (estimated) -->
                    <div class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-full">
                        <svg class="w-5 h-5 mr-2 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700 font-medium">{{ ceil(str_word_count(strip_tags($berita->isi)) / 200)
                            }} menit baca</span>
                    </div>
                </div>

                <!-- Enhanced Article Content -->
                <div class="prose prose-lg prose-blue max-w-none">
                    <div class="text-gray-700 leading-relaxed space-y-6 text-justify px-2 py-4">
                        {!! $berita->isi !!}
                    </div>
                </div>

                <!-- Enhanced Related Articles Navigation -->
                <div class="mt-12 pt-8 border-t border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Artikel Terkait</h3>
                    <div class="flex justify-between items-center gap-4">
                        <!-- Previous Article -->
                        @php
                        $previousBerita = \App\Models\Berita::where('created_at', '<', $berita->
                            created_at)->orderBy('created_at', 'desc')->first();
                            $nextBerita = \App\Models\Berita::where('created_at', '>',
                            $berita->created_at)->orderBy('created_at', 'asc')->first();
                            @endphp

                            @if($previousBerita)
                            <a href="{{ route('berita.show', $previousBerita->slug) }}"
                                class="flex-1 flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl transition-all duration-300 group">
                                <svg class="w-6 h-6 mr-3 text-blue-600 group-hover:scale-110 transition-transform"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-left">
                                    <span class="block text-xs text-blue-600 font-semibold mb-1">← Artikel
                                        Sebelumnya</span>
                                    <span
                                        class="text-sm font-medium text-gray-700 group-hover:text-blue-800 transition-colors">{{
                                        Str::limit($previousBerita->judul, 35) }}</span>
                                </div>
                            </a>
                            @else
                            <div class="flex-1"></div>
                            @endif

                            <!-- Divider -->
                            @if($previousBerita && $nextBerita)
                            <div class="w-px h-16 bg-gray-300"></div>
                            @endif

                            <!-- Next Article -->
                            @if($nextBerita)
                            <a href="{{ route('berita.show', $nextBerita->slug) }}"
                                class="flex-1 flex items-center justify-end p-4 bg-gradient-to-r from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl transition-all duration-300 group">
                                <div class="text-right mr-3">
                                    <span class="block text-xs text-purple-600 font-semibold mb-1">Artikel Selanjutnya
                                        →</span>
                                    <span
                                        class="text-sm font-medium text-gray-700 group-hover:text-purple-800 transition-colors">{{
                                        Str::limit($nextBerita->judul, 35) }}</span>
                                </div>
                                <svg class="w-6 h-6 text-purple-600 group-hover:scale-110 transition-transform"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            @endif
                    </div>
                </div>
            </div>
        </article>

        <!-- Enhanced Back to Berita Button -->
        <div class="mt-10 text-center">
            <a href="{{ route('berita') }}"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalContent = button.innerHTML;
        button.innerHTML = '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>Tersalin!';
        button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        button.classList.add('bg-green-600');
        
        setTimeout(function() {
            button.innerHTML = originalContent;
            button.classList.remove('bg-green-600');
            button.classList.add('bg-gray-600', 'hover:bg-gray-700');
        }, 2000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endsection