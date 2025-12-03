<?php
include 'koneksi.php';

// --- LOGIKA PHP TETAP SAMA SEPERTI YANG LAMA ---
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $berat = $_POST['berat'];
    mysqli_query($conn, "CALL tambah_cucian('$nama', '$berat')");
    header("Location: index.php");
}
if (isset($_GET['selesai_id'])) {
    $id = $_GET['selesai_id'];
    mysqli_query($conn, "UPDATE transaksi SET status='Selesai' WHERE id='$id'");
    header("Location: index.php");
}
if (isset($_GET['hapus_id'])) {
    $id = $_GET['hapus_id'];
    mysqli_query($conn, "DELETE FROM transaksi WHERE id='$id'");
    header("Location: index.php");
}
if (isset($_POST['export_python'])) {
    $output = shell_exec("python export_data.py");
    echo "<script>alert('Export Berhasil! Cek file laporan_laundry.txt');</script>";
}
// -----------------------------------------------
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Laundry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container"> <center>
            <h2>🧺 Aplikasi Simple Laundry</h2>
        </center>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Pelanggan" required autocomplete="off">
            <input type="number" step="0.1" name="berat" placeholder="Berat (Kg)" required>
            <button type="submit" name="simpan">Simpan</button>
        </form>
        
        <form method="POST">
            <button type="submit" name="export_python" style="width:100%">📂 Export Laporan via Python</button>
        </form>

        <br>
        <input type="text" id="keyword" placeholder="🔍 Cari nama pelanggan..." onkeyup="cariData()">
        
        <table id="tabel-laundry">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Berat</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Masuk</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($result)) {
    // Logic warna badge
    $badgeColor = "status-proses";
    if($row['status'] == 'Selesai') $badgeColor = "status-selesai";
    if($row['status'] == 'Diambil') $badgeColor = "status-diambil";

    // --- LOGIKA "SPACE | HAPUS" ---
    // Default: Tombol Selesai Normal
    $classSelesai = "btn-aksi btn-selesai"; 
    
    // Jika BUKAN Proses (sudah selesai/diambil), ubah jadi Invisible (Hantu)
    if ($row['status'] != 'Proses') {
        $classSelesai .= " btn-hidden"; // Tambah class hidden
    }

    echo "<tr>
        <td><strong>{$row['nama_pelanggan']}</strong></td>
        <td>{$row['berat_kg']} Kg</td>
        <td>Rp " . number_format($row['total_bayar']) . "</td>
        <td><span class='badge $badgeColor'>{$row['status']}</span></td>
        <td><small>{$row['tgl_masuk']}</small></td>
        <td><small>{$row['tgl_selesai']}</small></td>
        <td>
            <a href='index.php?selesai_id={$row['id']}' class='$classSelesai'>✅ Selesai</a>
            
            <a href='index.php?hapus_id={$row['id']}' class='btn-aksi btn-hapus' onclick='return confirm(\"Yakin hapus?\")'>🗑️ Hapus</a>
        </td>
    </tr>";
}
                ?>
            </tbody>
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>