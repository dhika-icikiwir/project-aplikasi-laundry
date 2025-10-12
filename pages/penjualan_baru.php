<?php
// FILE: penjualan_baru.php (atau pesan_baru.php) - Proses Form + Tampilan

include '../includes/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // PERBAIKAN: Menggunakan operator ternary untuk mengambil NILAI jika diset, 
    //            dan string kosong jika TIDAK diset.
    $nomor_hp = isset($_POST['no_hp_pelanggan']) ? $_POST['no_hp_pelanggan'] : '';
    $tanggal_masuk = isset($_POST['tgl_masuk']) ? $_POST['tgl_masuk'] : '';
    $layanan_form = isset($_POST['layanan']) ? $_POST['layanan'] : '';
    $berat_kg = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
    $status = isset($_POST['status_pesanan']) ? $_POST['status_pesanan'] : 'Masuk Antrean';

    // Perbaikan: Menggunakan logika ternary untuk tanggal_ambil_form sebelum pengecekan empty()
    $tanggal_ambil_form = isset($_POST['tgl_ambil']) ? $_POST['tgl_ambil'] : '';
    $tanggal_ambil = !empty($tanggal_ambil_form) ? "'" . $tanggal_ambil_form . "'" : 'NULL';


    $harga_per_layanan = 0;

    // Logika harga dan layanan (DIPERBAIKI: Nama layanan untuk cuci_setrika sekarang sesuai)
    if ($layanan_form == 'cuci') {
        $harga_per_layanan = 5000;
        $layanan_sql = 'cuci kiloan';
    } elseif ($layanan_form == 'setrika') {
        $harga_per_layanan = 3000;
        $layanan_sql = 'setrika baju';
    } elseif ($layanan_form == 'cuci_setrika') {
        $harga_per_layanan = 15000;
        $layanan_sql = 'cuci + setrika';  // <-- DIPERBAIKI: Sekarang sesuai layanan yang dipilih
    }

    $total_harga = $berat_kg * $harga_per_layanan;

    // ... (QUERY INSERT)
    $sql = "INSERT INTO `penjualan` (
                `nomor_hp`, `tanggal_masuk`, `tanggal_ambil`, 
                `total_harga`, `status`, `layanan`
            ) VALUES (
                '$nomor_hp', '$tanggal_masuk', $tanggal_ambil,
                '$total_harga', '$status', '$layanan_sql'
            )";

    if (mysqli_query($conn, $sql)) {
        header("Location: penjualan_daftar.php");
        exit;
    } else {
        echo "Error: Gagal menyimpan data penjualan.<br>" . mysqli_error($conn);
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Baru - Aplikasi Laundry</title>
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
                    Buat Pesanan Baru
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Isi form di bawah ini untuk membuat pesanan laundry baru dengan mudah dan cepat.
                </p>
            </div>

            <!-- Navigation -->
            <div class="text-center mb-8">
                <a href="dashboard.php" class="inline-block px-6 py-3 bg-primary-500 text-white rounded-full font-semibold hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="max-w-2xl mx-auto">
            <!-- Form Section -->
            <section class="bg-white p-8 rounded-xl shadow-lg">
                <form action="penjualan_baru.php" method="POST" class="space-y-6">
                    <!-- Nomor HP Pelanggan -->
                    <div>
                        <label for="no_hp_pelanggan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor HP Pelanggan
                        </label>
                        <input type="text" id="no_hp_pelanggan" name="no_hp_pelanggan" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300" 
                               placeholder="Masukkan nomor HP (contoh: 08123456789)" required>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tgl_masuk" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Masuk
                            </label>
                            <input type="date" id="tgl_masuk" name="tgl_masuk" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300" required>
                        </div>

                        <!-- Tanggal Ambil -->
                        <div>
                            <label for="tgl_ambil" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Ambil
                            </label>
                            <input type="date" id="tgl_ambil" name="tgl_ambil" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300" required>
                        </div>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <label for="layanan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Layanan Tersedia
                        </label>
                        <select id="layanan" name="layanan" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 bg-white">
                            <option value="cuci">Cuci Kiloan - Rp 5.000</option>
                            <option value="setrika">Setrika Pakaian - Rp 3.000</option>
                            <option value="cuci_setrika">Cuci + Setrika - Rp 15.000</option>
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div>
                        <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah (kg)
                        </label>
                        <input type="number" id="jumlah" name="jumlah" value="1" min="1" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300" 
                               placeholder="Masukkan jumlah kg" required>
                    </div>

                    <!-- Status Pesanan -->
                    <div>
                        <label for="status_pesanan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status Pesanan
                        </label>
                        <select id="status_pesanan" name="status_pesanan" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 bg-white">
                            <option value="Masuk Antrean">Masuk Antrean</option>
                            <option value="Sedang Dicuci">Sedang dicuci</option>
                            <option value="Proses Pengeringan">Proses Pengeringan</option>
                            <option value="Selesai">selesai</option>
                            <option value="Diambil">Diambil</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500">
                            Buat Transaksi
                        </button>
                        <button type="reset" 
                                class="flex-1 px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Reset Form
                        </button>
                    </div>
                </form>
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