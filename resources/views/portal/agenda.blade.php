@extends('portal.app')

@section('title', 'Agenda - SIPJAKI')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Agenda</h1>
<div class="bg-gradient-to-r from-blue-50 to-indigo-100 rounded-lg shadow-md p-8">

    @if($agenda->count() > 0)
    <!-- Agenda Table -->
    <div class="overflow-x-auto p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Waktu
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Acara
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tempat
                    </th>
                    {{-- <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Penanggung Jawab
                    </th> --}}
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Keterangan
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($agenda as $item)
                <tr class="hover:bg-blue-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $agenda->firstItem() + $loop->index }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->waktu }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $item->acara }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->tempat }}
                    </td>
                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->pj_agenda ?? '-' }}
                    </td> --}}
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $item->keterangan ? Str::limit($item->keterangan, 50) : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($agenda->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $agenda->links() }}
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="text-center py-12">
        <i class="fas fa-calendar-alt text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada agenda</h3>
        <p class="text-gray-500">Agenda kegiatan akan segera ditampilkan di halaman ini.</p>
    </div>
    @endif
</div>
@endsection