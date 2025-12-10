@extends('portal.app')

@section('title', 'Portal Informasi PUPR')

@section('content')
    <!-- 2 Grid: Slideshow Kiri dan Card Kanan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        <!-- Grid Kiri - Slideshow -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative h-96">
                    <!-- Slideshow Images -->
                    <div id="slideshow" class="relative h-full">
                        <div class="slide absolute inset-0 transition-opacity duration-500">
                            <img src="https://picsum.photos/seed/slide1/800/400.jpg" alt="Slide 1"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                                <h3 class="text-white text-2xl font-bold mb-2">Berita Utama 1</h3>
                                <p class="text-white/90">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Slideshow Controls -->
                    <button onclick="previousSlide()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button onclick="nextSlide()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Slide Indicators -->
                    <div class="absolute bottom-4 right-4 flex space-x-2">
                        <span class="w-2 h-2 bg-white rounded-full opacity-100"></span>
                        <span class="w-2 h-2 bg-white/50 rounded-full"></span>
                        <span class="w-2 h-2 bg-white/50 rounded-full"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Kanan - Card Informasi -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Pengumuman Penting</h3>
                </div>
                <p class="text-gray-600 mb-4">Pembukaan pendaftaran mahasiswa baru tahun ajaran 2025/2026 akan
                    dimulai pada tanggal 1 Januari 2025.</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Baca selengkapnya →</a>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 1 1 0 000 2H6a2 2 0 00-2 2v6a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-1a1 1 0 100-2h1a4 4 0 014 4v6a4 4 0 01-4 4H6a4 4 0 01-4-4V7a4 4 0 014-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Agenda Kegiatan</h3>
                </div>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span class="text-sm">15 Des: Seminar Nasional</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span class="text-sm">20 Des: Wisuda Periode Desember</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-2">•</span>
                        <span class="text-sm">25 Des: Libur Semester</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Card Informasi Tambahan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                </svg>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Pendidikan</h3>
                <p class="text-gray-600 text-sm mb-4">Program studi unggulan dengan kurikulum terkini dan metode
                    pembelajaran modern.</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Selengkapnya →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                        clip-rule="evenodd" />
                    <path
                        d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                </svg>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Penelitian</h3>
                <p class="text-gray-600 text-sm mb-4">Pusat penelitian dan pengembangan dengan berbagai publikasi
                    ilmiah berkualitas.</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Selengkapnya →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Teknologi</h3>
                <p class="text-gray-600 text-sm mb-4">Fasilitas teknologi modern untuk mendukung kegiatan akademik
                    dan penelitian.</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Selengkapnya →</a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Kemahasiswaan</h3>
                <p class="text-gray-600 text-sm mb-4">Berbagai kegiatan ekstrakurikuler dan organisasi mahasiswa
                    untuk pengembangan diri.</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Selengkapnya →</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let currentSlide = 0;
    const slides = [
        {
            image: 'https://picsum.photos/seed/slide1/800/400.jpg',
            title: 'Berita Utama 1',
            description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        },
        {
            image: 'https://picsum.photos/seed/slide2/800/400.jpg',
            title: 'Berita Utama 2',
            description: 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        },
        {
            image: 'https://picsum.photos/seed/slide3/800/400.jpg',
            title: 'Berita Utama 3',
            description: 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'
        }
    ];

    function showSlide(index) {
        const slideshow = document.getElementById('slideshow');
        const indicators = document.querySelectorAll('.absolute.bottom-4.right-4 span');
        
        slideshow.innerHTML = `
            <div class="slide absolute inset-0 transition-opacity duration-500">
                <img src="${slides[index].image}" alt="Slide ${index + 1}" class="w-full h-full object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h3 class="text-white text-2xl font-bold mb-2">${slides[index].title}</h3>
                    <p class="text-white/90">${slides[index].description}</p>
                </div>
            </div>
        `;
        
        indicators.forEach(function(indicator, i) {
            indicator.className = i === index ? 'w-2 h-2 bg-white rounded-full opacity-100' : 'w-2 h-2 bg-white/50 rounded-full';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function previousSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // Auto-advance slideshow
    setInterval(nextSlide, 5000);

    // Mobile Menu Toggle
    function toggleMobileMenu(event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }
        
        const navMenu = document.querySelector('.nav-menu');
        const overlay = document.querySelector('.mobile-menu-overlay');
        
        navMenu.classList.toggle('active');
        overlay.classList.toggle('hidden');
        
        // Prevent body scroll when menu is open
        if (navMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }

    // Close mobile menu when clicking outside
    function closeMobileMenuOnClickOutside(event) {
        const navMenu = document.querySelector('.nav-menu');
        const overlay = document.querySelector('.mobile-menu-overlay');
        const toggleButton = document.querySelector('.mobile-menu-toggle');
        
        // Check if menu is active and click is outside nav menu and toggle button
        if (navMenu.classList.contains('active') && 
            !navMenu.contains(event.target) && 
            !toggleButton.contains(event.target) &&
            !event.target.closest('.mobile-menu-toggle') &&
            !event.target.closest('.mobile-header-bar')) {
            
            navMenu.classList.remove('active');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
            
            // Close all open submenus
            const openSubmenus = document.querySelectorAll('.dropdown-menu.mobile-open');
            openSubmenus.forEach(function(menu) {
                menu.classList.remove('mobile-open');
                const arrowIcon = menu.parentElement.querySelector('.nav-link svg:last-child');
                if (arrowIcon) {
                    arrowIcon.style.transform = 'rotate(0deg)';
                }
            });
        }
    }

    // Mobile submenu toggle and close mobile menu when clicking on links
    document.addEventListener('DOMContentLoaded', function() {
        // Simple event delegation for mobile menu
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 1024) {
                // Handle mobile menu toggle button
                if (e.target.closest('#mobile-menu-toggle') || e.target.closest('.mobile-menu-toggle')) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleMobileMenu(e);
                    return;
                }
                
                // Handle nav links
                if (e.target.closest('.nav-link')) {
                    const navLink = e.target.closest('.nav-link');
                    const parentItem = navLink.parentElement;
                    const dropdown = parentItem.querySelector('.dropdown-menu');
                    
                    if (dropdown) {
                        // Check if this is a dropdown menu (has arrow icon)
                        const svgCount = navLink.querySelectorAll('svg').length;
                        const isDropdown = svgCount > 1;
                        
                        if (isDropdown) {
                            // This is a dropdown menu item - toggle submenu
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Close other open submenus first
                            const allDropdowns = document.querySelectorAll('.dropdown-menu.mobile-open');
                            allDropdowns.forEach(function(menu) {
                                if (menu !== dropdown) {
                                    menu.classList.remove('mobile-open');
                                    const otherArrow = menu.parentElement.querySelector('.nav-link svg:last-child');
                                    if (otherArrow) {
                                        otherArrow.style.transform = 'rotate(0deg)';
                                    }
                                }
                            });
                            
                            // Toggle current submenu
                            dropdown.classList.toggle('mobile-open');
                            
                            // Rotate arrow icon
                            const arrowIcon = navLink.querySelector('svg:last-child');
                            if (arrowIcon) {
                                arrowIcon.style.transform = dropdown.classList.contains('mobile-open') ? 'rotate(180deg)' : 'rotate(0deg)';
                            }
                        } else {
                            // This is a dropdown item link - close menu and navigate
                            e.stopPropagation();
                            toggleMobileMenu();
                        }
                    } else {
                        // This is a regular menu item without submenu - close menu and navigate
                        e.stopPropagation();
                        toggleMobileMenu();
                    }
                }
                
                // Handle dropdown item clicks
                if (e.target.closest('.dropdown-item')) {
                    if (window.innerWidth < 1024) {
                        // Close mobile menu when dropdown item is clicked
                        toggleMobileMenu();
                    }
                }
            }
        });

        // Initialize mobile menu toggle button event
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMobileMenu(e);
            });
        }

        // Initialize mobile menu overlay event
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMobileMenu(e);
            });
        }
    });

    // Add global click listener for closing mobile menu
    document.addEventListener('click', closeMobileMenuOnClickOutside);

    // Handle window resize
    window.addEventListener('resize', function() {
        const navMenu = document.querySelector('.nav-menu');
        const overlay = document.querySelector('.mobile-menu-overlay');
        
        if (window.innerWidth >= 1024) {
            navMenu.classList.remove('active');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
</script>
@endsection
