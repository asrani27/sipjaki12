@extends('portal.app')

@section('title', 'Berita - SIPJAKI')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Berita</h1><br />
<div class="bg-gradient-to-r from-blue-50 to-indigo-100 rounded-lg shadow-md p-8">

    @if($berita->count() > 0)
    <!-- Berita Table -->
    <div class="overflow-x-auto p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Gambar
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Judul
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Ringkasan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($berita as $item)
                <tr class="hover:bg-blue-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $berita->firstItem() + $loop->index }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->gambar)
                            <a href="{{ route('berita.show', $item->slug) }}" class="block">
                                <img src="{{ asset('storage/berita/gambar/' . $item->gambar) }}" 
                                     alt="{{ $item->judul }}" 
                                     class="w-16 h-16 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            </a>
                        @else
                            <a href="{{ route('berita.show', $item->slug) }}" class="block">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-300 transition-colors">
                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                </div>
                            </a>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('berita.show', $item->slug) }}" 
                           class="text-sm font-medium text-gray-900 hover:text-blue-600 transition-colors line-clamp-2">
                            {{ $item->judul }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ $item->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <p class="line-clamp-2">
                            {!! Str::limit(strip_tags($item->isi), 80) !!}
                        </p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('berita.show', $item->slug) }}" 
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors">
                            <i class="fas fa-eye mr-1"></i>
                            Baca
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada berita</h3>
                            <p class="text-gray-500">Berita akan segera tersedia</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($berita->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $berita->links() }}
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="text-center py-12">
        <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada berita</h3>
        <p class="text-gray-500">Berita akan segera tersedia</p>
    </div>
    @endif
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
