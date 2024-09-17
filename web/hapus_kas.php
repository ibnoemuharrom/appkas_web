<?php
// koneksi
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM transactions WHERE id='$id'");
if ($query) {
  echo "<script>location='data_kas.php';</script>";
} else {
  echo "<script>location='data_kas.php?failed';</script>";
}
?>