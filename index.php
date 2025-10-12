<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-primary-50 via-blue-50 to-indigo-100 min-h-screen">
    <!-- Navbar Fixed Top -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo/Brand -->
                <div class="flex items-center space-x-2">
                    <div class="bg-primary-500 text-white p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Aplikasi Laundry</h2>
                </div>

                <!-- Menu Links (Desktop) -->
                <div class="hidden md:flex space-x-6">
                    <a href="pages/dashboard.php" class="text-gray-700 hover:text-primary-600 font-semibold transition-colors px-3 py-2 rounded-md hover:bg-primary-50">
                        Dashboard
                    </a>
                    <a href="pages/penjualan_baru.php" class="text-gray-700 hover:text-primary-600 font-semibold transition-colors px-3 py-2 rounded-md hover:bg-primary-50">
                        Penjualan Baru
                    </a>
                    <a href="pages/penjualan_daftar.php" class="text-gray-700 hover:text-primary-600 font-semibold transition-colors px-3 py-2 rounded-md hover:bg-primary-50">
                        Daftar Penjualan
                    </a>
                    <a href="pages/laporan.php" class="text-gray-700 hover:text-primary-600 font-semibold transition-colors px-3 py-2 rounded-md hover:bg-primary-50">
                        Laporan
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700 hover:text-primary-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu (Dropdown) -->
            <div id="mobile-menu" class="md:hidden hidden mt-4 space-y-2 pb-4">
                <a href="pages/dashboard.php" class="block text-gray-700 hover:text-primary-600 font-semibold px-3 py-2 rounded-md hover:bg-primary-50">
                    Dashboard
                </a>
                <a href="pages/penjualan_baru.php" class="block text-gray-700 hover:text-primary-600 font-semibold px-3 py-2 rounded-md hover:bg-primary-50">
                    Penjualan Baru
                </a>
                <a href="pages/penjualan_daftar.php" class="block text-gray-700 hover:text-primary-600 font-semibold px-3 py-2 rounded-md hover:bg-primary-50">
                    Daftar Penjualan
                </a>
                <a href="pages/laporan.php" class="block text-gray-700 hover:text-primary-600 font-semibold px-3 py-2 rounded-md hover:bg-primary-50">
                    Laporan
                </a>
            </div>
        </div>
    </nav>

    <!-- Spacer untuk Navbar Fixed -->
    <div class="pt-20"></div>

    <!-- Hero Section -->
    <section class="text-center py-16 px-4">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-primary-600 to-blue-700 bg-clip-text text-transparent">
                Selamat Datang di Aplikasi Laundry
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Kelola bisnis laundry Anda dengan mudah. Pilih menu di atas untuk mulai navigasi.
            </p>
        </div>
    </section>

    <!-- Kotak-Kotak Menu Kecil (Compact Cards) -->
    <main class="container mx-auto px-4 py-12 pb-16">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Menu Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Dashboard -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="flex items-center mb-3">
                        <div class="bg-primary-500 text-white p-2 rounded-full mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Dashboard</h3>
                    </div>
                    <p class="text-sm text-gray-600">Lihat overview layanan.</p>
                    <a href="pages/dashboard.php" class="block mt-3 text-primary-600 hover:text-primary-700 font-medium text-sm">Buka Dashboard →</a>
                </div>

                <!-- Card 2: Penjualan Baru -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-500 text-white p-2 rounded-full mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Penjualan Baru</h3>
                    </div>
                    <p class="text-sm text-gray-600">Buat transaksi baru.</p>
                    <a href="pages/penjualan_baru.php" class="block mt-3 text-green-600 hover:text-green-700 font-medium text-sm">Mulai Penjualan →</a>
                </div>

                <!-- Card 3: Daftar Penjualan -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="flex items-center mb-3">
                        <div class="bg-purple-500 text-white p-2 rounded-full mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Penjualan</h3>
                    </div>
                    <p class="text-sm text-gray-600">Lihat semua transaksi.</p>
                    <a href="pages/penjualan_daftar.php" class="block mt-3 text-purple-600 hover:text-purple-700 font-medium text-sm">Lihat Daftar →</a>
                </div>

                <!-- Card 4: Laporan -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-gray-200">
                    <div class="flex items-center mb-3">
                        <div class="bg-yellow-500 text-white p-2 rounded-full mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Laporan</h3>
                    </div>
                    <p class="text-sm text-gray-600">Analisis penjualan.</p>
                    <a href="pages/laporan.php" class="block mt-3 text-yellow-600 hover:text-yellow-700 font-medium text-sm">Buat Laporan →</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-auto">
        <div class="container mx-auto px-4 py-6 text-center">
            <p class="text-gray-500 text-sm">&copy; 2023 Aplikasi Laundry. Dibuat untuk tugas sekolah dengan cinta ❤️.</p>
        </div>
    </footer>

    <!-- JavaScript untuk Mobile Menu Toggle -->
    <script>
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>