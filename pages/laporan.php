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
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-primary-600 to-blue-700 bg-clip-text text-transparent print:text-black print:bg-none print:text-3xl">
                    Laporan Penjualan
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed print:text-base print:text-black">
                    Ringkasan dan detail semua transaksi penjualan dengan analisis pendapatan.
                </p>
            </div>

            <!-- Navigation (Hanya hilang saat print) -->
            <div class="text-center mb-8 no-print">
                <a href="dashboard.php" class="inline-block px-6 py-3 bg-primary-500 text-white rounded-full font-semibold hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 mr-4">
                    Kembali ke Dashboard
                </a>
                <button onclick="window.print();" class="inline-block px-6 py-3 bg-green-500 text-white rounded-full font-semibold hover:bg-green-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Cetak Laporan
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto space-y-12">
            <!-- Ringkasan Total Section (Selalu muncul, termasuk print) -->
            <section class="bg-white p-8 rounded-xl shadow-lg text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-primary-600 to-blue-700 bg-clip-text text-transparent print:text-black print:bg-none print:text-2xl">
                    Ringkasan Total
                </h2>
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-lg border-l-4 border-green-500 print:bg-white print:border-gray-800">
                    <p class="text-2xl text-gray-700 mb-4 print:text-lg print:text-black">
                        <strong>Total Pendapatan:</strong>
                    </p>
                    <p class="text-4xl font-bold text-green-600 print:text-2xl print:text-black">
                        <?= formatRupiah($total_pendapatan); ?>
                    </p>
                    <p class="text-sm text-gray-500 mt-2 print:text-sm print:text-black">Berdasarkan semua transaksi yang tercatat.</p>
                </div>
            </section>

            <!-- Detail Transaksi Section (Selalu muncul, termasuk print) -->
            <section class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-primary-500">
                    <h2 class="text-2xl font-bold text-white text-center print:text-lg">
                        Detail Transaksi
                    </h2>
                </div>
                <div class="overflow-x-auto print:overflow-visible">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 print:bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider print:text-sm">No.</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider print:text-sm">Tgl Masuk</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider print:text-sm">Layanan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider print:text-sm">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-900 uppercase tracking-wider print:text-sm">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 print:divide-gray-800">
                            <?php
                            if (mysqli_num_rows($data_penjualan) > 0) {
                                while ($d = mysqli_fetch_array($data_penjualan)) {
                            ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-200 print:hover:bg-white">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium print:text-sm print:font-normal"><?= $no; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 print:text-sm"><?= formatTanggalIndonesia($d['tanggal_masuk']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 print:text-sm"><?= ucfirst(str_replace('_', ' ', $d['layanan'])); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 print:bg-blue-200 print:text-blue-900 print:px-2 print:py-0.5 print:text-sm">
                                            <?= ucfirst($d['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600 print:text-sm print:font-bold"><?= formatRupiah($d['total_harga']); ?></td>
                                </tr>
                            <?php
                                    $no++;
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-lg print:text-base print:text-black">Belum ada data penjualan.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-center text-sm text-gray-500 print:bg-white print:border-t print:border-gray-800 print:text-black">
                    <p>Total Transaksi: <?= $no - 1; ?> item</p>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer (Selalu muncul, termasuk print) -->
    <footer class="bg-white shadow-lg mt-auto">
        <div class="container mx-auto px-4 py-6 text-center border-t border-gray-200 print:border-t-2 print:border-black print:py-4">
            <hr class="my-4 border-gray-300 print:border-black">
            <p class="text-gray-500 text-sm print:text-black print:font-semibold">Dicetak pada: <?= date('d/m/Y H:i:s'); ?></p>
            <p class="text-gray-500 text-sm mt-2 print:text-black">&copy; 2025 Aplikasi Laundry. Dibuat untuk tugas sekolah SMK HIKMAH YAPIS.</p>
        </div>
    </footer>
</body>
</html>