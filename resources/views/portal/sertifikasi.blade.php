@extends('portal.app')

@section('title', 'Sertifikasi - SIPJAKI')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Sertifikasi</h1>
<div class="bg-gradient-to-r from-blue-50 to-indigo-100 rounded-lg shadow-md p-8">

    @if($sertifikasi->count() > 0)
    <!-- Sertifikasi Table -->
    <div class="overflow-x-auto p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Nama Sertifikasi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tahun
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tanggal Mulai
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Tanggal Selesai
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($sertifikasi as $item)
                <tr class="hover:bg-blue-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $sertifikasi->firstItem() + $loop->index }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                        <div>{{ $item->nama }}</div>
                        @if($item->nomor_sertifikat)
                        <div class="text-xs text-gray-500 font-normal">No. Sertifikat: {{ $item->nomor_sertifikat }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $item->tahun }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($item->waktu)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ \Carbon\Carbon::parse($item->selesai)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <button onclick="openModal({{ $item->id }})"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition duration-200">
                            Selengkapnya
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($sertifikasi->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $sertifikasi->links() }}
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="text-center py-12">
        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
        </svg>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada sertifikasi</h3>
        <p class="text-gray-500">Informasi sertifikasi akan segera ditampilkan di halaman ini.</p>
    </div>
    @endif
</div>

<!-- Modal Detail Sertifikasi -->
<div id="sertifikasiModal" class="fixed inset-0 bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h2 class="text-2xl font-bold">Detail Sertifikasi</h2>
            <button onclick="closeModal()" class="text-white hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-6" id="modalContent">
            <!-- Content will be loaded here -->
        </div>
        <div class="bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end">
            <button onclick="closeModal()"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>
<script>
    // Store sertifikasi data in JavaScript
    const sertifikasiData = {
        @foreach($sertifikasi as $item)
        {{ $item->id }}: {
            nama: "{{ $item->nama }}",
            nomor_sertifikat: "{{ $item->nomor_sertifikat ?? '-' }}",
            tahun: "{{ $item->tahun }}",
            kualifikasi: "{{ $item->kualifikasi }}",
            klasifikasi: "{{ $item->klasifikasi }}",
            jenjang_klasifikasi: "{{ $item->jenjang_klasifikasi ?? '-' }}",
            jenjang_kualifikasi: "{{ $item->jenjang_kualifikasi ?? '-' }}",
            jenjang: "{{ $item->jenjang }}",
            tanggal_mulai: "{{ \Carbon\Carbon::parse($item->waktu)->format('d/m/Y') }}",
            tanggal_selesai: "{{ \Carbon\Carbon::parse($item->selesai)->format('d/m/Y') }}",
            jam: "{{ $item->jam }}",
            metode: "{{ $item->metode }}",
            lokasi: "{{ $item->lokasi }}",
            sumber_dana: "{{ $item->sumber_dana }}",
            penanggung_jawab: "{{ $item->penanggung_jawab }}",
            keterangan: "{{ $item->keterangan }}"
        },
        @endforeach
    };

    function openModal(id) {
        const data = sertifikasiData[id];
        const modalContent = document.getElementById('modalContent');
        
        modalContent.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Sertifikasi</label>
                        <p class="text-gray-900 font-medium">${data.nama}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Sertifikat</label>
                        <p class="text-gray-900">${data.nomor_sertifikat}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun</label>
                        <p class="text-gray-900">${data.tahun}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kualifikasi</label>
                        <p class="text-gray-900">${data.kualifikasi}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenjang Kualifikasi</label>
                        <p class="text-gray-900">${data.jenjang_kualifikasi}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Klasifikasi</label>
                        <p class="text-gray-900">${data.klasifikasi}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenjang Klasifikasi</label>
                        <p class="text-gray-900">${data.jenjang_klasifikasi}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenjang</label>
                        <p class="text-gray-900">${data.jenjang}</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                        <p class="text-gray-900">${data.tanggal_mulai}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                        <p class="text-gray-900">${data.tanggal_selesai}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jam</label>
                        <p class="text-gray-900">${data.jam}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Metode</label>
                        <p class="text-gray-900">${data.metode}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                        <p class="text-gray-900">${data.lokasi}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sumber Dana</label>
                        <p class="text-gray-900">${data.sumber_dana}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Penanggung Jawab</label>
                        <p class="text-gray-900">${data.penanggung_jawab}</p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                <p class="text-gray-900 bg-gray-50 p-3 rounded">${data.keterangan || '-'}</p>
            </div>
        `;
        
        const modal = document.getElementById('sertifikasiModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('sertifikasiModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('sertifikasiModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endsection

