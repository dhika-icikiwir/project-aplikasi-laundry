<?php
// FILE: edit.php - Form Edit Penjualan

include '../includes/database.php';


// Jika form dikirim (method POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_penjualan = $_POST['id_penjualan'];
    $nomor_hp = $_POST['no_hp_pelanggan'];
    $tanggal_masuk = $_POST['tgl_masuk'];
    $layanan_form = $_POST['layanan'];
    $berat_kg = (int)$_POST['jumlah'];
    $status = $_POST['status_pesanan'];
    $tanggal_ambil_form = $_POST['tgl_ambil'];
    $tanggal_ambil = !empty($tanggal_ambil_form) ? "'$tanggal_ambil_form'" : 'NULL';

    if ($layanan_form == 'cuci') {
        $harga_per_layanan = 5000;
        $layanan_sql = 'cuci kiloan';
    } elseif ($layanan_form == 'setrika') {
        $harga_per_layanan = 3000;
        $layanan_sql = 'setrika baju';
    } elseif ($layanan_form == 'cuci_setrika') {
        $harga_per_layanan = 15000;
        $layanan_sql = 'cuci + setrika';
    } else {
        $harga_per_layanan = 0;
        $layanan_sql = 'lainnya';
    }

    $total_harga = $berat_kg * $harga_per_layanan;

    $sql = "UPDATE penjualan 
            SET nomor_hp='$nomor_hp',
                tanggal_masuk='$tanggal_masuk',
                tanggal_ambil=$tanggal_ambil,
                layanan='$layanan_sql',
                total_harga='$total_harga',
                status='$status'
            WHERE id_penjualan='$id_penjualan'";

    if (mysqli_query($conn, $sql)) {
        header("Location: penjualan_daftar.php?update=success");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($conn);
    }
}


// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo "Error: ID tidak valid.";
    header("Location: penjualan_daftar.php");
    exit;
}

// Query untuk ambil data berdasarkan ID (asumsi primary key: id_penjualan)
$sql = "SELECT * FROM penjualan WHERE id_penjualan = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Error: Data tidak ditemukan.";
    header("Location: penjualan_daftar.php");
    exit;
}

$row = mysqli_fetch_array($result);

// Mapping layanan dari DB ke value form dan hitung berat (kg) dari total_harga
$layanan_db = $row['layanan'];
$selected_layanan = '';
$berat_kg = 0;
$harga_per_layanan = 0;

if ($layanan_db == 'cuci kiloan') {
    $selected_layanan = 'cuci';
    $harga_per_layanan = 5000;
} elseif ($layanan_db == 'setrika baju') {
    $selected_layanan = 'setrika';
    $harga_per_layanan = 3000;
} elseif ($layanan_db == 'cuci + setrika') {
    $selected_layanan = 'cuci_setrika';
    $harga_per_layanan = 15000;
}

// Hitung berat dari total_harga (asumsi total_harga sudah benar; jika 0, set default 1)
if ($harga_per_layanan > 0 && $row['total_harga'] > 0) {
    $berat_kg = (int)($row['total_harga'] / $harga_per_layanan);
} else {
    $berat_kg = 1; // Default jika perhitungan gagal
}

// Format tanggal untuk input date (Y-m-d)
$tgl_masuk = date('Y-m-d', strtotime($row['tanggal_masuk']));
$tgl_ambil = ($row['tanggal_ambil'] && $row['tanggal_ambil'] != '0000-00-00') ? date('Y-m-d', strtotime($row['tanggal_ambil'])) : '';

// Status (langsung ambil dari DB)
$status = $row['status'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan - Aplikasi Laundry</title>
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
                    Edit Pesanan
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Edit data pesanan existing dengan mudah. Ubah detail dan simpan perubahan.
                </p>
            </div>

            <!-- Navigation -->
            <div class="text-center mb-8">
                <a href="penjualan_daftar.php" class="inline-block px-6 py-3 bg-primary-500 text-white rounded-full font-semibold hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Kembali ke Daftar Penjualan
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="max-w-2xl mx-auto">
            <!-- Form Section -->
            <section class="bg-white p-8 rounded-xl shadow-lg">
                <form action="proses_edit.php" method="POST" class="space-y-6">
                    <!-- Hidden ID untuk proses edit -->
                    <input type="hidden" name="id_penjualan" value="<?= $row['id_penjualan']; ?>">

                    <!-- Nomor HP Pelanggan -->
                    <div>
                        <label for="no_hp_pelanggan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor HP Pelanggan
                        </label>
                        <input type="text" id="no_hp_pelanggan" name="no_hp_pelanggan" 
                               value="<?= htmlspecialchars($row['nomor_hp']); ?>"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300" 
                               placeholder="Masukkan nomor HP (contoh: 08123456789)" required>
                    </div>

                    <!-- Tanggal Masuk dan Ambil -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tgl_masuk" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Masuk
                            </label>
                            <input type="date" id="tgl_masuk" name="tgl_masuk" 
                                   value="<?= $tgl_masuk; ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300" required>
                        </div>

                        <div>
                            <label for="tgl_ambil" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Ambil
                            </label>
                            <input type="date" id="tgl_ambil" name="tgl_ambil" 
                                   value="<?= $tgl_ambil; ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300">
                        </div>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <label for="layanan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Layanan Tersedia
                        </label>
                        <select id="layanan" name="layanan" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 bg-white">
                            <option value="cuci" <?= ($selected_layanan == 'cuci') ? 'selected' : ''; ?>>Cuci Kiloan - Rp 5.000</option>
                            <option value="setrika" <?= ($selected_layanan == 'setrika') ? 'selected' : ''; ?>>Setrika Pakaian - Rp 3.000</option>
                            <option value="cuci_setrika" <?= ($selected_layanan == 'cuci_setrika') ? 'selected' : ''; ?>>Cuci + Setrika - Rp 15.000</option>
                        </select>
                    </div>

                    <!-- Jumlah (kg) - Dihitung ulang dari total_harga existing -->
                    <div>
                        <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah (kg)
                        </label>
                        <input type="number" id="jumlah" name="jumlah" value="<?= $berat_kg; ?>" min="1" 
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
                            <option value="Masuk Antrean" <?= ($status == 'Masuk Antrean') ? 'selected' : ''; ?>>Masuk Antrean</option>
                            <option value="Sedang Dicuci" <?= ($status == 'Sedang Dicuci') ? 'selected' : ''; ?>>Sedang dicuci</option>
                            <option value="Proses Pengeringan" <?= ($status == 'Proses Pengeringan') ? 'selected' : ''; ?>>Proses Pengeringan</option>
                            <option value="Selesai" <?= ($status == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                            <option value="Diambil" <?= ($status == 'Diambil') ? 'selected' : ''; ?>>Diambil</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="submit" 
                                class="flex-1 px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500">
                            Update Transaksi
                        </button>
                        <a href="penjualan_daftar.php" 
                           class="flex-1 px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-center flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Batal
                        </a>
                    </div>
                </form>
            </section>
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