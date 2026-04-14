@extends('layouts.app')

@section('title', 'Kelola Tertib Pemanfaatan')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Tertib Pemanfaatan</h1>
            <p class="text-gray-600 mt-1">Kelola data pengawasan tertib pemanfaatan</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openImportModal()"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-file-import"></i>
                <span>Import</span>
            </button>
            <a href="{{ route('superadmin.pengawasan.tertib_pemanfaatan.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Tambah Data</span>
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-400 p-3 mb-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
            <div class="ml-auto">
                <button onclick="this.parentElement.parentElement.parentElement.remove()"
                    class="text-green-400 hover:text-green-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Search Form -->
    <div class="bg-white shadow-sm rounded-lg p-4 mb-6">
        <form method="GET" action="{{ route('superadmin.pengawasan.tertib_pemanfaatan.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama badan usaha, NIB, SBU, atau nama paket..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-search"></i>
            </button>
            @if(request('search'))
            <a href="{{ route('superadmin.pengawasan.tertib_pemanfaatan.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                <i class="fas fa-times"></i>
            </a>
            @endif
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead style="background: linear-gradient(72deg, rgb(51, 95, 185) 0%, rgb(242, 143, 7) 100%);">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Nama Badan Usaha
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            No. NIB
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            No. SBU
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Nama Paket
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tertibPemanfaatan as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $tertibPemanfaatan->firstItem() + $loop->index }}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-900">
                            {{ $item->nama_badan_usaha ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->no_nib ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->no_sbu ?? '-' }}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-900">
                            {{ $item->nama_paket ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('superadmin.pengawasan.tertib_pemanfaatan.show', $item) }}"
                                    class="text-blue-600 hover:text-blue-900 transition-colors" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('superadmin.pengawasan.tertib_pemanfaatan.edit', $item) }}"
                                    class="text-amber-600 hover:text-amber-900 transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('superadmin.pengawasan.tertib_pemanfaatan.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 block"></i>
                                <span class="text-lg">Tidak ada data Tertib Pemanfaatan</span>
                                <p class="text-sm mt-1">Mulai dengan menambahkan data baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($tertibPemanfaatan->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $tertibPemanfaatan->links() }}
    </div>
    @endif
</div>

<!-- Import Modal -->
<div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Import Data Tertib Pemanfaatan</h3>
            <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('superadmin.pengawasan.tertib_pemanfaatan.import') }}" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">File Excel</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Format yang didukung: .xlsx, .xls, .csv</p>
            </div>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                <p class="text-sm text-yellow-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Import dimulai dari baris ke-2. Pastikan format file sesuai dengan template.
                </p>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeImportModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-upload mr-1"></i> Import
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Error Alert for Import -->
@if(session('error'))
<div class="bg-red-50 border border-red-400 p-3 mb-6 rounded-lg shadow-md">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-400"></i>
        </div>
        <div class="ml-3">
            <p class="text-sm text-red-700">{{ session('error') }}</p>
        </div>
        <div class="ml-auto">
            <button onclick="this.parentElement.parentElement.parentElement.remove()"
                class="text-red-400 hover:text-red-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>
@endif

<script>
function openImportModal() {
    document.getElementById('importModal').classList.remove('hidden');
}

function closeImportModal() {
    document.getElementById('importModal').classList.add('hidden');
}

// Close modal on outside click
document.getElementById('importModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImportModal();
    }
});
</script>
@endsection
