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
<body class="bg-gradient-to-br from-primary-50 via-blue-50 to-indigo-100 min-h-screen flex flex-col">
    <!-- Header Section -->
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-primary-600 to-blue-700 bg-clip-text text-transparent">
                Selamat Datang di Aplikasi Laundry
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Ini adalah halaman utama aplikasi manajemen laundry. Pilih menu di bawah ini untuk navigasi yang mudah dan cepat.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <li>
                    <a href="pages/dashboard.php" class="block bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-primary-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800">Dashboard</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">Lihat layanan tersedia.</p>
                    </a>
                </li>
                <li>
                    <a href="pages/penjualan_baru.php" class="block bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-green-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800">Penjualan Baru</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">Buat penjualan laundry baru dengan proses yang sederhana dan efisien.</p>
                    </a>
                </li>
                <li>
                    <a href="pages/penjualan_daftar.php" class="block bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-purple-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800">Daftar Penjualan</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">Lihat semua penjualan dengan detail lengkap dan pencarian mudah.</p>
                    </a>
                </li>
                <li class="md:col-span-2 lg:col-span-1">
                    <a href="pages/laporan.php" class="block bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-yellow-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-yellow-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800">Laporan</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">Buat laporan penjualan berdasarkan tanggal dengan analisis mendalam.</p>
                    </a>
                </li>
            </ul>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-auto">
        <div class="container mx-auto px-4 py-6 text-center">
            <p class="text-gray-500 text-sm">&copy; 2023 Aplikasi Laundry. Dibuat untuk tugas sekolah dengan cinta ❤️.</p>
        </div>
    </footer>
</body>
</html>