<?php
// koneksi
include "koneksi.php";

$id = $_GET['id'];
$delete = mysqli_query($koneksi, "DELETE FROM categories WHERE id='$id'");
if ($delete) {
  echo "<script>location='kategori.php';</script>";
} else {
  echo "<script>location='kategori.php?failed';</script>";
}
?>