<?php
// koneksi
include "koneksi.php";

$id = $_GET['id'];
$delete = mysqli_query($koneksi, "DELETE FROM users WHERE id='$id'");
if ($delete) {
  echo "<script>alert('User berhasil di hapus.');</script>";
  echo "<script>location='data_user.php';</script>";
} else {
  echo "<script>alert('User gagal di hapus.');</script>";
  echo "<script>location='data_user.php?failed';</script>";
}
?>