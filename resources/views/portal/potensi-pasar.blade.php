@extends('portal.app')

@section('title', 'Potensi Pasar - SIPJAKI')

@section('content')
<div class="bg-gradient-to-r from-green-50 to-emerald-100 rounded-lg shadow-md p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Potensi Pasar</h1>

    @if($potensi->count() > 0)
    <!-- Potensi Table -->
    <div class="overflow-x-auto p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tahun
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Sumber Dana
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Besar Anggaran
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Penanggung Jawab
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Infrastruktur
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Layanan
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($potensi as $item)
                <tr class="hover:bg-green-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $potensi->firstItem() + $loop->index }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                        {{ $item->tahun }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->sumber_dana }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        Rp {{ number_format($item->besar_anggaran, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->penanggung_jawab }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $item->infrastruktur ? \Illuminate\Support\Str::limit($item->infrastruktur, 50) : '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $item->layanan ? \Illuminate\Support\Str::limit($item->layanan, 50) : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($potensi->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $potensi->links() }}
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="text-center py-12">
        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada data potensi pasar</h3>
        <p class="text-gray-500">Informasi potensi pasar akan segera ditampilkan di halaman ini.</p>
    </div>
    @endif
</div>
@endsection