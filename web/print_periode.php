<?php
include "koneksi.php";

$tanggal_awal = $_POST["date_1"];
$tanggal_akhir = $_POST["date_2"];
?>

<?php
// kas masuk
$sql = mysqli_query($koneksi, "SELECT SUM(amount) as total_masuk FROM transactions WHERE type='IN' and date BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
$masuk = $data['total_masuk'];
}

// kas keluar
$sql = mysqli_query($koneksi, "SELECT SUM(amount) as total_keluar FROM transactions WHERE type='OUT' and date BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
$keluar = $data['total_keluar'];
}

$saldo = $masuk - $keluar;
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Rekap Laporan Kas</title>
</head>
<body>
<center>
<h2>Laporan Rekapitulasi Kas CV. Jaya Mukti</h2>
<p>
    Periode : <?php $periode_1 = $tanggal_awal; echo date("d M Y", strtotime($periode_1)); ?> s/d
    <?php $periode_2 = $tanggal_akhir; echo date("d M Y", strtotime($periode_2)); ?>
</p>

  <table border="1" width="100%">
    <thead>
      <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Type</th>
            <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
        <?php

        if(isset($_POST["print"])) {
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM transactions INNER JOIN categories ON transactions.category_id = categories.id WHERE date BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY date ASC");
            while ($data = mysqli_fetch_array($query, MYSQLI_BOTH)) {
        ?>
         <tr>
            <td><?php echo $no++; ?></td>
            <td><?php  $tgl = $data['date']; echo date("d M Y", strtotime($tgl))?></td> 
            <td><?php echo $data['description']; ?></td>
            <td><?php echo $data['name']; ?></td>  
            <td><?php echo $data['type']; ?></td>  
            <td align="right"><?php echo number_format($data['amount']); ?></td>   
        </tr>
        <?php
            }
        }
        ?>
    </tbody>
    <tr>
        <td colspan="5">Total Pemasukan</td>
        <td align="right"><b><?php echo number_format($masuk); ?></b></td>
    </tr>
    <tr>
        <td colspan="5">Total Pengeluaran</td>
        <td align="right"><b><?php echo number_format($keluar); ?></b></td>
    </tr>
    <tr>
        <td colspan="5">Saldo Kas</td>
        <td align="right"><b><?php echo number_format($saldo); ?></b></td>
    </tr>
  </table>
</center>

<script>
    window.onload = function () {
        window.print();
        setTimeout(window.close, 500);
    }
</script>
</body>
</html>