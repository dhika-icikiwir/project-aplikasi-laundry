<?php
// FILE: laporan_penjualan.php

include '../includes/database.php';

// 1. QUERY UNTUK MENGAMBIL SEMUA DATA PENJUALAN
$sql_penjualan = "SELECT * FROM penjualan ORDER BY tanggal_masuk DESC";
$data_penjualan = mysqli_query($conn, $sql_penjualan);

// 2. QUERY UNTUK MENGHITUNG TOTAL PENDAPATAN
$sql_total = "SELECT SUM(total_harga) AS total_pendapatan FROM penjualan";
$data_total = mysqli_query($conn, $sql_total);
// Mengambil hasil perhitungan total
$total_pendapatan = mysqli_fetch_array($data_total)['total_pendapatan'];

// Fungsi sederhana untuk mengubah format tanggal ke format Indonesia
function formatTanggalIndonesia($tanggal_db) {
    if (empty($tanggal_db) || $tanggal_db == '0000-00-00' || $tanggal_db == '0000-00-00 00:00:00') {
        return '-';
    }
    // Daftar nama bulan dalam Bahasa Indonesia
    $bulan = array (
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juli', 
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $timestamp = strtotime($tanggal_db);
    $tgl = date('d', $timestamp);
    $bln = date('n', $timestamp);
    $thn = date('Y', $timestamp);
    return $tgl . ' ' . $bulan[$bln] . ' ' . $thn;
}

// Fungsi untuk format mata uang Rupiah tanpa JavaScript
function formatRupiah($angka) {
    // Memastikan angka yang diformat adalah numerik
    $angka = (float) $angka; 
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

$no = 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Penjualan - Aplikasi Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100">

  <!-- ✅ Navbar putih (seperti halaman penjualan) -->
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
        <a href="dashboard.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Dashboard</a>
        <a href="penjualan_daftar.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Penjualan</a>
        <a href="laporan.php" class="text-blue-600 font-semibold px-3 py-2 rounded-md bg-blue-50">Laporan</a>
        <a href="#" onclick="window.print();" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold">Cetak</a>
      </div>
    </div>
  </nav>

  <!-- ✅ Konten utama -->
  <main class="flex-grow container mx-auto px-4 py-12">
    <div class="max-w-6xl mx-auto space-y-12">

      <!-- Ringkasan Total -->
      <section class="bg-white p-8 rounded-xl shadow-lg text-center">
        <h2 class="text-3xl font-bold text-blue-700 mb-6">Ringkasan Total</h2>
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-lg border-l-4 border-green-500">
          <p class="text-2xl text-gray-700 mb-4"><strong>Total Pendapatan:</strong></p>
          <p class="text-4xl font-bold text-green-600">
            <?= formatRupiah($total_pendapatan); ?>
          </p>
          <p class="text-sm text-gray-500 mt-2">Berdasarkan semua transaksi yang tercatat.</p>
        </div>
      </section>

      <!-- Detail Transaksi -->
      <section class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-blue-500">
          <h2 class="text-2xl font-bold text-white text-center">Detail Transaksi</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">No.</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">Tgl Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">Layanan</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider">Total Harga</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php if (mysqli_num_rows($data_penjualan) > 0): ?>
                <?php while ($d = mysqli_fetch_array($data_penjualan)): ?>
                  <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-900"><?= $no++; ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= formatTanggalIndonesia($d['tanggal_masuk']); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= ucfirst(str_replace('_', ' ', $d['layanan'])); ?></td>
                    <td class="px-6 py-4 text-sm">
                      <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                        <?= ucfirst($d['status']); ?>
                      </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-green-600"><?= formatRupiah($d['total_harga']); ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-lg">Belum ada data penjualan.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 text-center text-sm text-gray-500">
          <p>Total Transaksi: <?= $no - 1; ?> item</p>
        </div>
      </section>
    </div>
  </main>

  <!-- ✅ Footer nempel di bawah -->
  <footer class="bg-white shadow-inner mt-auto border-t border-gray-200">
    <div class="container mx-auto px-4 py-6 text-center">
      <p class="text-gray-500 text-sm">
        Dicetak pada: <?= date('d/m/Y H:i:s'); ?>
      </p>
      <p class="text-gray-500 text-sm mt-2">
        &copy; 2025 Aplikasi Laundry. Dibuat untuk tugas sekolah SMK HIKMAH YAPIS.
      </p>
    </div>
  </footer>

</body>
</html>
