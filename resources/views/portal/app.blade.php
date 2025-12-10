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
        }

        .mobile-menu-toggle:hover {
            background: #f3f4f6;
            transform: scale(1.05);
        }

        .mobile-menu-toggle svg {
            color: #374151;
        }

        @media (max-width: 1024px) {
            .mobile-menu-toggle {
                display: block;
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
    <div class="mobile-header-bar lg:hidden fixed top-4 left-4 z-[60] flex items-center">
        <!-- Mobile Menu Toggle -->
        <button id="mobile-menu-toggle"
            class="mobile-menu-toggle p-4 rounded-lg bg-white shadow-lg hover:bg-gray-100 transition relative z-[60]">
            <svg class="w-6 h-6 text-gray-700 pointer-events-none" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    @include('portal.menu')

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