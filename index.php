<?php
include './includes/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Aplikasi Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-md w-full">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <div class="bg-blue-500 text-white p-2 rounded-lg">
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"
            ></path>
          </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-800">Aplikasi Laundry</h2>
      </div>

      <!-- Menu -->
      <div class="space-x-6 hidden md:flex">
        <a href="index.php" class="text-blue-600 font-semibold px-3 py-2 rounded-md bg-blue-50">Dashboard</a>
        <a href="pages/penjualan_baru.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Penjualan Baru</a>
        <a href="pages/penjualan_daftar.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Daftar Penjualan</a>
        <a href="pages/laporan.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Laporan</a>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <main class="flex-grow container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Selamat Datang di Aplikasi Laundry</h1>
    <p class="text-gray-600 max-w-xl mx-auto mb-8">
      Aplikasi ini membantu Anda mengelola penjualan, mencatat transaksi, dan membuat laporan laundry dengan mudah dan cepat.
    </p>
    <a href="pages/penjualan_baru.php"
      class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
      Mulai Penjualan
    </a>
  </main>

  <!-- Footer -->
  <footer class="bg-white shadow-inner mt-auto">
    <div class="container mx-auto px-4 py-6 text-center">
      <p class="text-gray-500 text-sm">
        &copy; 2025 Aplikasi Laundry. Dibuat untuk tugas sekolah SMK HIKMAH YAPIS.
      </p>
    </div>
  </footer>

</body>
</html>
