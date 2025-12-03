<?php
include 'koneksi.php';
$q = $_GET['q'];

$query = "SELECT * FROM transaksi WHERE nama_pelanggan LIKE '%$q%' ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        $badgeColor = "status-proses";
        if($row['status'] == 'Selesai') $badgeColor = "status-selesai";
        if($row['status'] == 'Diambil') $badgeColor = "status-diambil";

        // Logic Tombol Hantu (Sama persis kayak index.php)
        $classSelesai = "btn-aksi btn-selesai"; 
        if ($row['status'] != 'Proses') {
            $classSelesai .= " btn-hidden";
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
} else {
    echo "<tr><td colspan='7' style='text-align:center;'>Data tidak ditemukan</td></tr>";
}
?>