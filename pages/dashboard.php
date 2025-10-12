<?php
include '../includes/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Laundry</title>
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
        <div class="container mx-auto px-4 py-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-primary-600 to-blue-700 bg-clip-text text-transparent">
                    Dashboard Admin Laundry
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Selamat datang di dashboard! Di sini Anda bisa melihat ringkasan aktivitas laundry dengan tampilan yang mudah dipahami.
                </p>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-wrap justify-center gap-4 mb-8">
                <a href="../index.php" class="px-6 py-3 bg-primary-500 text-white rounded-full font-semibold hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Kembali ke Beranda
                </a>
                <a href="penjualan_baru.php" class="px-6 py-3 bg-green-500 text-white rounded-full font-semibold hover:bg-green-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Penjualan Baru
                </a>
                <a href="penjualan_daftar.php" class="px-6 py-3 bg-purple-500 text-white rounded-full font-semibold hover:bg-purple-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Daftar Penjualan
                </a>
                <a href="laporan.php" class="px-6 py-3 bg-yellow-500 text-white rounded-full font-semibold hover:bg-yellow-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Laporan
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Layanan Tersedia Section -->
            <section class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center bg-gradient-to-r from-primary-600 to-blue-700 bg-clip-text text-transparent">
                    Layanan Tersedia
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Cuci Kiloan Card -->
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-blue-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Cuci Kiloan</h3>
                        </div>
                        <p class="text-2xl font-bold text-green-600 mb-2">Rp 5.000</p>
                        <p class="text-gray-600 text-sm">Layanan cuci pakaian per kilogram untuk kebutuhan sehari-hari.</p>
                    </div>

                    <!-- Setrika Pakaian Card -->
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-green-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Setrika Pakaian</h3>
                        </div>
                        <p class="text-2xl font-bold text-green-600 mb-2">Rp 3.000</p>
                        <p class="text-gray-600 text-sm">Layanan setrika profesional untuk pakaian yang rapi dan licin.</p>
                    </div>

                    <!-- Cuci + Setrika Card -->
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border-l-4 border-purple-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-purple-500 text-white p-3 rounded-full mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547zM9 10a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Cuci + Setrika</h3>
                        </div>
                        <p class="text-2xl font-bold text-green-600 mb-2">Rp 15.000</p>
                        <p class="text-gray-600 text-sm">Paket lengkap cuci dan setrika untuk hasil sempurna dan hemat waktu.</p>
                    </div>
                </div>
            </section>

            <!-- Placeholder for Future Stats (Opsional, bisa dihapus jika tidak diperlukan) -->
            <section class="text-center">
                <p class="text-gray-500 italic">Ringkasan aktivitas akan ditampilkan di sini setelah integrasi database lengkap.</p>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-auto">
        <div class="container mx-auto px-4 py-6 text-center">
            <p class="text-gray-500 text-sm">&copy; 2025 Aplikasi Laundry. Dibuat untuk tugas sekolah SMK HIKMAH YAPIS.</p>
        </div>
    </footer>
</body>
</html>