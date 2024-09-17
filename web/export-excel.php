<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-data-kas.xls");
?>
<center><h3>Rekap Data Kas CV. Jaya Mukti</h3></center>
<table border="1">
	<thead>
      <tr>
        <th>No</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
        <th>Kategori</th>
        <th>Type</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $query = mysqli_query($koneksi, "SELECT * FROM transactions INNER JOIN categories ON transactions.category_id = categories.id");
      while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['description']; ?></td>
        <td><?= $row['date']; ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['type']; ?></td>
        <td>Rp. <?= number_format($row['amount']); ?></td>
      </tr>
      <?php } ?>
    </tbody>
</table>