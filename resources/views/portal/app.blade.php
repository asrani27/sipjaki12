<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Informasi PUPR')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Fallback styles untuk memastikan warna terlihat */
        .header-custom {
            background: linear-gradient(72deg, rgb(51, 95, 185) 0%, rgb(242, 143, 7) 100%);
        }

        /* Custom fonts untuk header */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;800;900&family=Inter:wght@400;500;600&display=swap');

        .sipjaki-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.3);
            letter-spacing: -0.02em;
        }

        .sipjaki-subtitle {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .logo-container {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            transition: transform 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        /* Navigation Menu Styles */
        .nav-menu {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 2px solid rgba(51, 95, 185, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 40;
            clear: both;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            color: #374151 !important;
            transition: all 0.3s ease;
            padding: 0.7rem 0.5rem;
            border-radius: 0.5rem;
            margin: 0.25rem;
            display: flex;
            align-items: center;
            text-decoration: none !important;
        }

        .nav-link:hover {
            color: rgb(51, 95, 185) !important;
            transform: translateY(-2px);
            background: rgba(51, 95, 185, 0.1);
            box-shadow: 0 4px 15px rgba(51, 95, 185, 0.2);
            text-decoration: none !important;
        }

        .nav-link svg {
            transition: all 0.3s ease;
            stroke: #374151 !important;
            fill: none;
        }

        .nav-link:hover svg {
            transform: scale(1.1);
            stroke: rgb(51, 95, 185) !important;
        }

        .nav-link span {
            color: #374151 !important;
        }

        .nav-link:hover span {
            color: rgb(51, 95, 185) !important;
        }

        .nav-list {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-list .nav-item {
            display: inline-block;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 0.75rem;
            backdrop-filter: blur(10px);
            min-width: 280px;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 50;
        }

        .nav-item:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            color: #374151;
            padding: 0.875rem 1.25rem;
            position: relative;
            border-radius: 0.5rem;
            margin: 0.25rem;
            display: block;
            text-decoration: none;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(51, 95, 185, 0.1) 0%, rgba(242, 143, 7, 0.1) 100%);
            opacity: 0;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .dropdown-item:hover::before {
            opacity: 1;
        }

        .dropdown-item:hover {
            color: rgb(51, 95, 185);
            border-left-color: rgb(51, 95, 185);
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .dropdown-item svg {
            transition: all 0.3s ease;
        }

        .dropdown-item:hover svg {
            color: rgb(51, 95, 185);
            transform: scale(1.1);
        }

        .mobile-menu-toggle {
            display: none;
            background: white;
            border: none;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            padding: 0.75rem;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 60;
            position: relative;
        }

        .mobile-menu-toggle:hover {
            background: #f3f4f6;
            transform: scale(1.05);
        }

        .mobile-menu-toggle svg {
            color: #374151;
            stroke: currentColor;
        }

        @media (max-width: 1024px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                left: -100%;
                width: 80%;
                max-width: 320px;
                height: 100vh;
                background: linear-gradient(135deg, rgb(51, 95, 185) 0%, rgb(242, 143, 7) 100%);
                transition: transform 0.3s ease;
                z-index: 999;
                overflow-y: auto;
                box-shadow: 5px 0 25px rgba(0, 0, 0, 0.3);
                transform: translateX(-100%);
            }

            .nav-menu.active {
                transform: translateX(0);
                left: 0;
            }

            .nav-list {
                flex-direction: column;
                padding: 4rem 0 1rem 0;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                padding: 1rem 1.5rem !important;
                margin: 0.125rem 1rem;
                border-radius: 0.5rem;
                color: rgba(255, 255, 255, 0.95) !important;
                background: transparent !important;
            }

            .nav-link:hover {
                color: #ffffff !important;
                background: rgba(255, 255, 255, 0.1) !important;
                transform: none !important;
                box-shadow: none !important;
            }

            .nav-link svg {
                stroke: rgba(255, 255, 255, 0.95) !important;
            }

            .nav-link:hover svg {
                stroke: #ffffff !important;
            }

            .nav-link span {
                color: rgba(255, 255, 255, 0.95) !important;
            }

            .nav-link:hover span {
                color: #ffffff !important;
            }

            .dropdown-menu {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border: none;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                margin: 0.25rem 1rem;
                border-radius: 0.5rem;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .dropdown-menu.mobile-open {
                max-height: 500px;
            }

            .dropdown-item {
                padding: 0.875rem 2rem;
                color: rgba(255, 255, 255, 0.9);
                border-left: 4px solid rgba(255, 255, 255, 0.3);
                background: transparent !important;
            }

            .dropdown-item:hover {
                background: rgba(255, 255, 255, 0.2) !important;
                color: #ffffff !important;
                border-left-color: #ffffff !important;
                text-decoration: none !important;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header
        class="bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 text-white shadow-xl relative overflow-hidden header-custom"
        style="background: linear-gradient(72deg, rgb(51, 95, 185) 0%, rgb(242, 143, 7) 100%);">
        <!-- Pattern Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\" 60\"
                height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\"
                fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36
                34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6
                4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container mx-auto px-4 py-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center lg:items-start space-y-4 lg:space-y-0">
                <!-- Logo dan Brand - Moved to Left -->
                <div class="flex items-center space-x-6 w-full">
                    <!-- Logo PUPR -->
                    <div class="relative logo-container">
                        <div class="h-16 flex items-center justify-center">
                            <img src="/logo/sipjaki.png" alt="SIPJAKI Logo" class="w-full h-full object-contain">
                        </div>
                    </div>

                    <!-- Text Brand -->
                    <div class="text-left">
                        <h1 class="sipjaki-title text-3xl lg:text-4xl">Sistem Informasi Pembina Jasa Konstruksi</h1>
                        <p class="sipjaki-subtitle text-sm lg:text-base mt-2">DINAS PUPR KOTA BANJARMASIN</p>
                    </div>
                </div>

            </div>

            <!-- Bottom Border Accent -->
            <div
                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400">
            </div>
        </div>
    </header>

    <!-- Mobile Header Bar - Fixed Position -->
    {{-- <div class="mobile-header-bar lg:hidden fixed top-4 left-4 z-[60] flex items-center">
        <!-- Mobile Menu Toggle -->
        <button
            class="mobile-menu-toggle-header p-4 rounded-lg bg-white shadow-lg hover:bg-gray-100 transition relative z-[60]">
            <svg class="w-6 h-6 text-gray-700 pointer-events-none" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div> --}}

    <!-- Navigation Menu -->
    <nav class="nav-menu shadow-lg sticky top-0 z-40">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Menu -->
                <ul class="nav-list hidden lg:flex items-center space-x-0">
                    <li class="nav-item">
                        <a href="/" class="nav-link px-4 py-4 block">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Beranda</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link px-4 py-4 block w-full text-left">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profil</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('struktur-organisasi') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    <span>Struktur Organisasi</span>
                                </div>
                            </a>
                            <a href="{{ route('renstra') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Renstra</span>
                                </div>
                            </a>
                            <a href="{{ route('tupoksi') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Tupoksi</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link px-4 py-4 block w-full text-left">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Informasi</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('berita') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Berita</span>
                                </div>
                            </a>
                            <a href="{{ route('agenda') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                    </svg>
                                    <span>Agenda</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link px-4 py-4 block w-full text-left">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span>Pelatihan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('sertifikasi') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Sertifikasi</span>
                                </div>
                            </a>
                            <a href="{{ route('bimtek') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                    </svg>
                                    <span>Bimtek</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link px-4 py-4 block w-full text-left">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span>Pengawasan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('tertib-usaha') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Tertib Usaha</span>
                                </div>
                            </a>
                            <a href="{{ route('tertib-penyelenggara') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 000 2h6a1 1 0 100-2H7zm0 4a1 1 0 000 2h2a1 1 0 100-2H7z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Tertib Penyelenggara</span>
                                </div>
                            </a>
                            <a href="{{ route('tertib-pemanfaatan') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM8.5 12.5l1.5-1.5 1.5 1.5-1.5 1.5-1.5-1.5z" />
                                    </svg>
                                    <span>Tertib Pemanfaatan</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link px-4 py-4 block w-full text-left">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Jakon</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('ska-skt') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>SKA/SKT</span>
                                </div>
                            </a>
                            <a href="{{ route('penanggung-jawab-teknik') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Penanggung Jawab Teknik</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('tim-pembina') }}" class="nav-link px-4 py-4 block">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Tim Pembina</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link px-4 py-4 block w-full text-left">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>SPM</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('spm-informasi') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Informasi</span>
                                </div>
                            </a>
                            <a href="{{ route('spm-laporan') }}" class="dropdown-item">
                                <div class="flex items-center space-x-3">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 2a1 1 0 00-1 1v1a1 1 0 002 0V5a1 1 0 00-1-1zm0 4a1 1 0 100 2h4a1 1 0 100-2H8zm0 4a1 1 0 100 2h4a1 1 0 100-2H8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Laporan</span>
                                </div>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('potensi-pasar') }}" class="nav-link px-4 py-4 block">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                <span>Potensi Pasar</span>
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('peraturan') }}" class="nav-link px-4 py-4 block">
                            <span class="flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Peraturan</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden">
            <!-- Mobile Menu Sidebar -->
            <div class="mobile-menu-sidebar fixed left-0 top-0 h-full w-80 bg-white shadow-xl transform -translate-x-full transition-transform duration-300">
                <div class="p-4 border-b">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Menu</h2>
                        <button class="mobile-menu-close p-2 rounded-lg hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Mobile Menu Items -->
                <ul class="mobile-nav-list">
                    <li class="mobile-nav-item">
                        <a href="/" class="mobile-nav-link px-4 py-3 block hover:bg-gray-50">
                            <span class="flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Beranda</span>
                            </span>
                        </a>
                    </li>
                    <li class="mobile-nav-item">
                        <button class="mobile-dropdown-toggle mobile-nav-link px-4 py-3 block w-full text-left hover:bg-gray-50">
                            <span class="flex items-center justify-between">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Profil</span>
                                </span>
                                <svg class="w-4 h-4 dropdown-arrow transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="mobile-dropdown-menu hidden">
                            <a href="{{ route('struktur-organisasi') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Struktur Organisasi</a>
                            <a href="{{ route('renstra') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Renstra</a>
                            <a href="{{ route('tupoksi') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Tupoksi</a>
                        </div>
                    </li>
                    <li class="mobile-nav-item">
                        <button class="mobile-dropdown-toggle mobile-nav-link px-4 py-3 block w-full text-left hover:bg-gray-50">
                            <span class="flex items-center justify-between">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Informasi</span>
                                </span>
                                <svg class="w-4 h-4 dropdown-arrow transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="mobile-dropdown-menu hidden">
                            <a href="{{ route('berita') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Berita</a>
                            <a href="{{ route('agenda') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Agenda</a>
                        </div>
                    </li>
                    <li class="mobile-nav-item">
                        <button class="mobile-dropdown-toggle mobile-nav-link px-4 py-3 block w-full text-left hover:bg-gray-50">
                            <span class="flex items-center justify-between">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span>Pelatihan</span>
                                </span>
                                <svg class="w-4 h-4 dropdown-arrow transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="mobile-dropdown-menu hidden">
                            <a href="{{ route('sertifikasi') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Sertifikasi</a>
                            <a href="{{ route('bimtek') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Bimtek</a>
                        </div>
                    </li>
                    <li class="mobile-nav-item">
                        <button class="mobile-dropdown-toggle mobile-nav-link px-4 py-3 block w-full text-left hover:bg-gray-50">
                            <span class="flex items-center justify-between">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>Pengawasan</span>
                                </span>
                                <svg class="w-4 h-4 dropdown-arrow transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="mobile-dropdown-menu hidden">
                            <a href="{{ route('tertib-usaha') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Tertib Usaha</a>
                            <a href="{{ route('tertib-penyelenggara') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Tertib Penyelenggara</a>
                            <a href="{{ route('tertib-pemanfaatan') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Tertib Pemanfaatan</a>
                        </div>
                    </li>
                    <li class="mobile-nav-item">
                        <button class="mobile-dropdown-toggle mobile-nav-link px-4 py-3 block w-full text-left hover:bg-gray-50">
                            <span class="flex items-center justify-between">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Jakon</span>
                                </span>
                                <svg class="w-4 h-4 dropdown-arrow transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="mobile-dropdown-menu hidden">
                            <a href="{{ route('ska-skt') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">SKA/SKT</a>
                            <a href="{{ route('penanggung-jawab-teknik') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Penanggung Jawab Teknik</a>
                        </div>
                    </li>
                    <li class="mobile-nav-item">
                        <button class="mobile-dropdown-toggle mobile-nav-link px-4 py-3 block w-full text-left hover:bg-gray-50">
                            <span class="flex items-center justify-between">
                                <span class="flex items-center space-x-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span>SPM</span>
                                </span>
                                <svg class="w-4 h-4 dropdown-arrow transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>
                        <div class="mobile-dropdown-menu hidden">
                            <a href="{{ route('spm-informasi') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Informasi</a>
                            <a href="{{ route('spm-laporan') }}" class="mobile-dropdown-item px-12 py-2 block hover:bg-gray-50">Laporan</a>
                        </div>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="{{ route('tim-pembina') }}" class="mobile-nav-link px-4 py-3 block hover:bg-gray-50">
                            <span class="flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Tim Pembina</span>
                            </span>
                        </a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="{{ route('potensi-pasar') }}" class="mobile-nav-link px-4 py-3 block hover:bg-gray-50">
                            <span class="flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                <span>Potensi Pasar</span>
                            </span>
                        </a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="{{ route('peraturan') }}" class="mobile-nav-link px-4 py-3 block hover:bg-gray-50">
                            <span class="flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>Peraturan</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- JavaScript for Mobile Menu -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle all toggle buttons with event delegation
        const mobileMenuToggles = document.querySelectorAll('.mobile-menu-toggle');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        const mobileMenuSidebar = document.querySelector('.mobile-menu-sidebar');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        // Debug: Log elements to verify they exist
        console.log('Mobile menu elements:', {
            toggles: mobileMenuToggles.length,
            overlay: !!mobileMenuOverlay,
            sidebar: !!mobileMenuSidebar,
            closeBtn: !!mobileMenuClose,
            dropdowns: mobileDropdownToggles.length
        });

        // Toggle mobile menu
        mobileMenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Mobile menu toggle clicked');
                
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.remove('hidden');
                    console.log('Overlay shown');
                }
                
                if (mobileMenuSidebar) {
                    setTimeout(() => {
                        mobileMenuSidebar.classList.remove('-translate-x-full');
                        console.log('Sidebar shown');
                    }, 10);
                }
            });
        });

        // Close mobile menu
        function closeMobileMenu() {
            console.log('Closing mobile menu');
            if (mobileMenuSidebar) {
                mobileMenuSidebar.classList.add('-translate-x-full');
            }
            setTimeout(() => {
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.add('hidden');
                }
            }, 300);
        }

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', function(e) {
                e.preventDefault();
                closeMobileMenu();
            });
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', function(e) {
                if (e.target === mobileMenuOverlay) {
                    closeMobileMenu();
                }
            });
        }

        // Toggle mobile dropdowns
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const dropdownMenu = this.nextElementSibling;
                const arrow = this.querySelector('.dropdown-arrow');
                
                if (!dropdownMenu) return;
                
                const isOpen = !dropdownMenu.classList.contains('hidden');
                console.log('Dropdown toggle clicked, isOpen:', isOpen);
                
                // Close all other dropdowns
                mobileDropdownToggles.forEach(otherToggle => {
                    if (otherToggle !== toggle) {
                        const otherMenu = otherToggle.nextElementSibling;
                        const otherArrow = otherToggle.querySelector('.dropdown-arrow');
                        if (otherMenu) {
                            otherMenu.classList.add('hidden');
                        }
                        if (otherArrow) {
                            otherArrow.classList.remove('rotate-180');
                        }
                    }
                });
                
                // Toggle current dropdown
                if (isOpen) {
                    dropdownMenu.classList.add('hidden');
                    if (arrow) {
                        arrow.classList.remove('rotate-180');
                    }
                } else {
                    dropdownMenu.classList.remove('hidden');
                    if (arrow) {
                        arrow.classList.add('rotate-180');
                    }
                }
            });
        });

        // Handle escape key to close menu
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenuOverlay && !mobileMenuOverlay.classList.contains('hidden')) {
                closeMobileMenu();
            }
        });
    });
    </script>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">Portal Informasi</h4>
                    <p class="text-gray-400 text-sm">Menyediakan informasi terkini dan terpercaya untuk seluruh civitas
                        akademika.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Link Cepat</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">E-Learning</a></li>
                        <li><a href="#" class="hover:text-white transition">Perpustakaan</a></li>
                        <li><a href="#" class="hover:text-white transition">Jurnal Online</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>Email: info@portal.ac.id</li>
                        <li>Telepon: (021) 1234-5678</li>
                        <li>Fax: (021) 1234-5679</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849-.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; 2025 Portal Informasi. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>
