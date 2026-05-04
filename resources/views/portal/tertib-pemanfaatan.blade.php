@extends('portal.app')

@section('title', 'Tertib Pemanfaatan - SIPJAKI')

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tertib Pemanfaatan</h1>

    @if($tertibPemanfaatan->isEmpty())
    <div class="text-center py-12">
        <p class="text-gray-500">Belum ada data Tertib Pemanfaatan.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gradient-to-r from-blue-600 to-orange-500 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Badan Usaha</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">No. NIB</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">No. SBU</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Paket</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($tertibPemanfaatan as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-4 py-4 text-sm text-gray-900">{{ $item->nama_badan_usaha ?? '-' }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->no_nib ?? '-' }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->no_sbu ?? '-' }}</td>
                    <td class="px-4 py-4 text-sm text-gray-900">{{ $item->nama_paket ?? '-' }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm">
                        <button onclick="openDetailModal({{ json_encode($item) }})"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs transition-colors">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<!-- Detail Modal -->
<div id="detailModal"
    class="fixed inset-0  backdrop-blur-sm bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-white border-b px-6 py-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Detail Tertib Pemanfaatan</h3>
            <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6" id="modalContent">
            <!-- Content will be populated by JavaScript -->
        </div>

        <!-- Modal Footer -->
        <div class="border-t px-6 py-4 bg-gray-50">
            <button onclick="closeDetailModal()"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function openDetailModal(data) {
    const modal = document.getElementById('detailModal');
    const content = document.getElementById('modalContent');
    
    const formatDate = (date) => {
        if (!date) return '-';
        return new Date(date).toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
    };
    
    const formatCurrency = (amount) => {
        if (!amount) return '-';
        return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
    };
    
    content.innerHTML = `
        <!-- Identitas Badan Usaha -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-3 pb-2 border-b">Identitas Badan Usaha</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Badan Usaha</label>
                    <p class="text-sm text-gray-900">${data.nama_badan_usaha || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Pimpinan</label>
                    <p class="text-sm text-gray-900">${data.nama_pimpinan || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">No. NIB</label>
                    <p class="text-sm text-gray-900">${data.no_nib || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">No. SBU</label>
                    <p class="text-sm text-gray-900">${data.no_sbu || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">NPWP</label>
                    <p class="text-sm text-gray-900">${data.npwp || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">No. Telepon</label>
                    <p class="text-sm text-gray-900">${data.no_telp || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Email</label>
                    <p class="text-sm text-gray-900">${data.email || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Instansi</label>
                    <p class="text-sm text-gray-900">${data.instansi || '-'}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-medium text-gray-500 mb-1">Alamat</label>
                    <p class="text-sm text-gray-900">${data.alamat || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Kabupaten/Kota</label>
                    <p class="text-sm text-gray-900">${data.kab_kota || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Provinsi</label>
                    <p class="text-sm text-gray-900">${data.provinsi || '-'}</p>
                </div>
            </div>
        </div>
        
        <!-- Informasi Usaha -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-3 pb-2 border-b">Informasi Usaha</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Jenis Usaha</label>
                    <p class="text-sm text-gray-900">${data.jenis_usaha || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Sifat Usaha</label>
                    <p class="text-sm text-gray-900">${data.sifat_usaha || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Klasifikasi Usaha</label>
                    <p class="text-sm text-gray-900">${data.klasifikasi_usaha || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Kualifikasi Usaha</label>
                    <p class="text-sm text-gray-900">${data.kualifikasi_usaha || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Layanan Usaha</label>
                    <p class="text-sm text-gray-900">${data.layanan_usaha || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">No. Reg SBU</label>
                    <p class="text-sm text-gray-900">${data.no_reg_sbu || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Masa Berlaku SBU</label>
                    <p class="text-sm text-gray-900">${formatDate(data.masa_berlaku_sbu)}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Status BPJS</label>
                    <p class="text-sm text-gray-900">${data.status_bpjs || '-'}</p>
                </div>
            </div>
        </div>
        
        <!-- Informasi Paket & Survey -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-3 pb-2 border-b">Informasi Paket & Survey</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Waktu Survey</label>
                    <p class="text-sm text-gray-900">${formatDate(data.waktu_survey)}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nama Paket</label>
                    <p class="text-sm text-gray-900">${data.nama_paket || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nilai Kontrak</label>
                    <p class="text-sm text-gray-900">${formatCurrency(data.nilai_kontrak)}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Lama Pekerjaan</label>
                    <p class="text-sm text-gray-900">${data.lama_pekerjaan || '-'}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Mulai Kontrak</label>
                    <p class="text-sm text-gray-900">${formatDate(data.tanggal_mulai_kontrak)}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Tanggal Berakhir Kontrak</label>
                    <p class="text-sm text-gray-900">${formatDate(data.tanggal_berakhit_kontrak)}</p>
                </div>
            </div>
        </div>
        
        <!-- Dokumen -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-3 pb-2 border-b">Dokumen</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">URL File NIB</label>
                    ${data.url_file_nib ? '<a href="' + data.url_file_nib + '" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm"><i class="fas fa-external-link-alt mr-1"></i>Lihat File</a>' : '<p class="text-sm text-gray-900">-</p>'}
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">URL File SBU</label>
                    ${data.url_file_sbu ? '<a href="' + data.url_file_sbu + '" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm"><i class="fas fa-external-link-alt mr-1"></i>Lihat File</a>' : '<p class="text-sm text-gray-900">-</p>'}
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">URL Kwitansi</label>
                    ${data.url_kwitansi ? '<a href="' + data.url_kwitansi + '" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm"><i class="fas fa-external-link-alt mr-1"></i>Lihat File</a>' : '<p class="text-sm text-gray-900">-</p>'}
                </div>
            </div>
        </div>
    `;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDetailModal();
    }
});
</script>
@endsection
