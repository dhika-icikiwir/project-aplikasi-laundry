<?php
// FILE: penjualan_baru.php (atau pesan_baru.php) - Proses Form + Tampilan

include '../includes/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$nomor_hp = $_POST['no_hp_pelanggan'];
$tanggal_masuk = $_POST['tgl_masuk'];
$layanan_form = $_POST['layanan'];
$berat_kg = (int)$_POST['jumlah'];
$status = $_POST['status_pesanan'];

$tanggal_ambil_form = $_POST['tgl_ambil'];
if (!empty($tanggal_ambil_form)) {
    $tanggal_ambil = "'" . $tanggal_ambil_form . "'";
} else {
    $tanggal_ambil = 'NULL';
}

$harga_per_layanan = 0;

    if ($layanan_form == 'cuci') {
        $harga_per_layanan = 5000;
        $layanan_sql = 'cuci kiloan';
    } elseif ($layanan_form == 'setrika') {
        $harga_per_layanan = 3000;
        $layanan_sql = 'setrika baju';
    } elseif ($layanan_form == 'cuci_setrika') {
        $harga_per_layanan = 15000;
        $layanan_sql = 'cuci + setrika'; 
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buat Pesanan Baru | Aplikasi Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100 min-h-screen flex flex-col">

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
        <a href="../index.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50 transition duration-300">Dashboard</a>
        <a href="penjualan_baru.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50 transition duration-300">Penjualan Baru</a>
        <a href="penjualan_daftar.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50 transition duration-300">Daftar Penjualan</a>
        <a href="laporan.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50 transition duration-300">Laporan</a>
      </div>
    </div>
  </nav>

  <!-- Header Section -->

  <!-- Main Content -->
  <main class="flex-grow container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
      <form action="penjualan_baru.php" method="POST" class="space-y-6">
        <!-- Nomor HP -->
        <div>
          <label for="no_hp_pelanggan" class="block text-sm font-semibold text-gray-700 mb-2">
            Nomor HP Pelanggan
          </label>
          <input type="text" id="no_hp_pelanggan" name="no_hp_pelanggan"
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                 placeholder="Masukkan nomor HP (contoh: 08123456789)" required>
        </div>

        <!-- Tanggal -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="tgl_masuk" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Masuk</label>
            <input type="date" id="tgl_masuk" name="tgl_masuk"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
          </div>

          <div>
            <label for="tgl_ambil" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Ambil</label>
            <input type="date" id="tgl_ambil" name="tgl_ambil"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
          </div>
        </div>

        <!-- Layanan -->
        <div>
          <label for="layanan" class="block text-sm font-semibold text-gray-700 mb-2">Layanan Tersedia</label>
          <select id="layanan" name="layanan"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
            <option value="cuci">Cuci Kiloan - Rp 5.000</option>
            <option value="setrika">Setrika Pakaian - Rp 3.000</option>
            <option value="cuci_setrika">Cuci + Setrika - Rp 15.000</option>
          </select>
        </div>

        <!-- Jumlah -->
        <div>
          <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah (kg)</label>
          <input type="number" id="jumlah" name="jumlah" value="1" min="1"
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                 placeholder="Masukkan jumlah kg" required>
        </div>

        <!-- Status -->
        <div>
          <label for="status_pesanan" class="block text-sm font-semibold text-gray-700 mb-2">Status Pesanan</label>
          <select id="status_pesanan" name="status_pesanan"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
            <option value="Masuk Antrean">Masuk Antrean</option>
            <option value="Sedang Dicuci">Sedang Dicuci</option>
            <option value="Proses Pengeringan">Proses Pengeringan</option>
            <option value="Selesai">Selesai</option>
            <option value="Diambil">Diambil</option>
          </select>
        </div>

        <!-- Tombol -->
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          <button type="submit"
                  class="flex-1 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 shadow-md">
            Buat Transaksi
          </button>
          <button type="reset"
                  class="flex-1 px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-300 shadow-md">
            Reset Form
          </button>
        </div>
      </form>
    </div>
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
