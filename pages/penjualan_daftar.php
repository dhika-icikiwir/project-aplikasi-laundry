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
                    Daftar Penjualan Laundry
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Lihat daftar semua penjualan yang telah dibuat dengan detail lengkap dan mudah dikelola.
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
        <div class="max-w-6xl mx-auto">
            <!-- Table Section -->
            <section class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-primary-500">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nomor HP</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Total Harga</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal Pesanan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal Pengambilan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status Pesanan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Layanan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            if (mysqli_num_rows($data) > 0) {
                                while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $no; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $d['nomor_hp']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">Rp <?= number_format($d['total_harga'], 0, ',', '.'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d/m/Y', strtotime($d['tanggal_masuk'])); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d/m/Y', strtotime($d['tanggal_ambil'])); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <?= ucfirst($d['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= ucfirst($d['layanan']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="proses_edit.php?id=<?= $d['id_penjualan']; ?>" 
                                           class="text-blue-600 hover:text-blue-900 font-semibold transition-colors duration-200">
                                            Edit
                                        </a>
                                        <a href="proses_delete.php?id=<?= $d['id_penjualan']; ?>" 
                                           class="text-red-600 hover:text-red-900 font-semibold transition-colors duration-200"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                    $no++;
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500 text-lg">Tidak ada data penjualan tersedia.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Info Section (Opsional: Tambahan untuk stats sederhana) -->
            <div class="mt-8 text-center text-gray-500">
                <p>Total Penjualan: <?= $no - 1; ?> transaksi</p>
            </div>
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