<?php
include '../includes/database.php';
$no = 1;
$sql = "SELECT * FROM penjualan";
$data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Penjualan - Aplikasi Laundry</title>
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
        <a href="../index.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Dashboard</a>
        <a href="penjualan_baru.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Penjualan Baru</a>
        <a href="penjualan_daftar.php" class="text-blue-600 font-semibold px-3 py-2 rounded-md bg-blue-50">Daftar Penjualan</a>
        <a href="laporan.php" class="text-gray-700 hover:text-blue-600 font-semibold px-3 py-2 rounded-md hover:bg-blue-50">Laporan</a>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <main class="flex-grow container mx-auto px-4 py-12">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-blue-700 mb-2">Daftar Penjualan Laundry</h1>
      <p class="text-gray-600 text-lg">Lihat semua transaksi laundry yang telah dibuat.</p>
    </div>

    <div class="max-w-6xl mx-auto">
      <section class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-500">
              <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">No</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nomor HP</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Total Harga</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal Masuk</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal Ambil</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Layanan</th>
                <th colspan="2" class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php if (mysqli_num_rows($data) > 0): ?>
                <?php while ($d = mysqli_fetch_array($data)): ?>
                  <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-900"><?= $no++; ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= $d['nomor_hp']; ?></td>
                    <td class="px-6 py-4 text-sm font-semibold text-green-600">Rp <?= number_format($d['total_harga'], 0, ',', '.'); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= date('d/m/Y', strtotime($d['tanggal_masuk'])); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= date('d/m/Y', strtotime($d['tanggal_ambil'])); ?></td>
                    <td class="px-6 py-4 text-sm">
                      <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                        <?= ucfirst($d['status']); ?>
                      </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= ucfirst($d['layanan']); ?></td>
                    <td class="px-6 py-4 text-sm font-medium space-x-2">
                      <a href="proses_edit.php?id=<?= $d['id_penjualan']; ?>" class="text-blue-600 hover:text-blue-900 font-semibold">Edit</a>
                    </td>
                    <td>
                      <a href="proses_delete.php?id=<?= $d['id_penjualan']; ?>" class="text-red-600 hover:text-red-900 font-semibold" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="px-6 py-12 text-center text-gray-500 text-lg">Tidak ada data penjualan tersedia.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </section>

      <div class="mt-8 text-center text-gray-500">
        <p>Total Penjualan: <?= $no - 1; ?> transaksi</p>
      </div>
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
