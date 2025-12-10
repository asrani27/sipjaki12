<!-- Sidebar -->
<aside id="sidebar"
    class="sidebar-transition w-64 bg-white shadow-xl flex-shrink-0 fixed lg:relative h-full z-40 -translate-x-full lg:translate-x-0">

    <div class="flex flex-col h-full">
        <!-- Logo Section -->
        <div class="gradient-pattern p-6 text-white">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-2xl font-bold text-blue-600">S</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold">SIPJAKI</h1>
                    <p class="text-xs opacity-90">Sistem Informasi Jasa Konstruksi</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 custom-scrollbar overflow-y-auto">
            <!-- Beranda -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600' : 'text-gray-700' }} rounded-lg hover:bg-blue-100 transition-colors">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-500' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="font-medium">Beranda</span>
            </a>

            <!-- Profil -->
            <div class="nav-item">
                <button onclick="toggleSubmenu('profil-submenu')"
                    class="flex items-center justify-between w-full px-4 py-3 {{ request()->routeIs('superadmin.profil.*') ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600' : 'text-gray-600' }} rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <span class="flex items-center space-x-3">
                        <svg class="w-5 h-5 {{ request()->routeIs('superadmin.profil.*') ? 'text-blue-600' : 'text-gray-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil</span>
                    </span>
                    <svg id="profil-arrow"
                        class="w-4 h-4 arrow-icon {{ request()->routeIs('superadmin.profil.*') ? 'rotate' : '' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="profil-submenu"
                    class="submenu pl-12 space-y-1 {{ request()->routeIs('superadmin.profil.*') ? 'open' : '' }}">
                    <a href="{{ route('superadmin.profil.struktur.edit') }}"
                        class="block px-4 py-2 text-sm {{ request()->routeIs('superadmin.profil.struktur.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-gray-900">Struktur
                        Organisasi</a>
                    <a href="{{ route('superadmin.profil.renstra.edit') }}"
                        class="block px-4 py-2 text-sm {{ request()->routeIs('superadmin.profil.renstra.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-gray-900">Renstra</a>
                    <a href="{{ route('superadmin.profil.tupoksi.edit') }}"
                        class="block px-4 py-2 text-sm {{ request()->routeIs('superadmin.profil.tupoksi.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-gray-900">Tupoksi</a>
                </div>
            </div>

            <!-- Informasi -->
            <div class="nav-item">
                <button onclick="toggleSubmenu('informasi-submenu')"
                    class="flex items-center justify-between w-full px-4 py-3 {{ request()->routeIs('superadmin.berita.*') || request()->routeIs('superadmin.agenda.*') ? 'text-blue-600 bg-blue-50 border-l-4 border-blue-600' : 'text-gray-600' }} rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <span class="flex items-center space-x-3">
                        <svg class="w-5 h-5 {{ request()->routeIs('superadmin.berita.*') || request()->routeIs('superadmin.agenda.*') ? 'text-blue-600' : 'text-gray-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Informasi</span>
                    </span>
                    <svg id="informasi-arrow"
                        class="w-4 h-4 arrow-icon {{ request()->routeIs('superadmin.berita.*') || request()->routeIs('superadmin.agenda.*') ? 'rotate' : '' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="informasi-submenu"
                    class="submenu pl-12 space-y-1 {{ request()->routeIs('superadmin.berita.*') || request()->routeIs('superadmin.agenda.*') ? 'open' : '' }}">
                    <a href="{{ route('superadmin.berita.index') }}"
                        class="block px-4 py-2 text-sm {{ request()->routeIs('superadmin.berita.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-gray-900">Berita</a>
                    <a href="{{ route('superadmin.agenda.index') }}" class="block px-4 py-2 text-sm {{ request()->routeIs('superadmin.agenda.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-gray-900">Agenda</a>
                </div>
            </div>

            <!-- Pelatihan -->
            <div class="nav-item">
                <button onclick="toggleSubmenu('pelatihan-submenu')"
                    class="flex items-center justify-between w-full px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <span class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Pelatihan</span>
                    </span>
                    <svg id="pelatihan-arrow" class="w-4 h-4 arrow-icon" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="pelatihan-submenu" class="submenu pl-12 space-y-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Sertifikasi</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Bimtek</a>
                </div>
            </div>

            <!-- Pengawasan -->
            <div class="nav-item">
                <button onclick="toggleSubmenu('pengawasan-submenu')"
                    class="flex items-center justify-between w-full px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <span class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>Pengawasan</span>
                    </span>
                    <svg id="pengawasan-arrow" class="w-4 h-4 arrow-icon" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="pengawasan-submenu" class="submenu pl-12 space-y-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Tertib Usaha</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Tertib
                        Penyelenggara</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Tertib Pemanfaatan</a>
                </div>
            </div>

            <!-- Jakon -->
            <div class="nav-item">
                <button onclick="toggleSubmenu('jakon-submenu')"
                    class="flex items-center justify-between w-full px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <span class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Jakon</span>
                    </span>
                    <svg id="jakon-arrow" class="w-4 h-4 arrow-icon" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="jakon-submenu" class="submenu pl-12 space-y-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">SKA/SKT</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Penanggung Jawab
                        Teknik</a>
                </div>
            </div>

            <!-- Tim Pembina -->
            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Tim Pembina</span>
            </a>

            <!-- SPM -->
            <div class="nav-item">
                <button onclick="toggleSubmenu('spm-submenu')"
                    class="flex items-center justify-between w-full px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                    <span class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>SPM</span>
                    </span>
                    <svg id="spm-arrow" class="w-4 h-4 arrow-icon" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="spm-submenu" class="submenu pl-12 space-y-1">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Informasi</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Laporan</a>
                </div>
            </div>

            <!-- Potensi Pasar -->
            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <span>Potensi Pasar</span>
            </a>

            <!-- Peraturan -->
            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Peraturan</span>
            </a>
        </nav>

        <!-- User Profile Section -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-blue-500 to-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'admin@sipjaki.id' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
