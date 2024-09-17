<?php 
// koneksi
include 'koneksi.php';
include 'include/function_tanggal.php';

session_start();

if (!isset($_SESSION['users']['id']) || empty($_SESSION['users']['id'])) {
  header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'include/head.php'; ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="rekap_periode.php" class="btn btn-md btn-primary">Rekap Periode <i class="fas fa-print"></i></a>
            <a href="export-excel.php" class="btn btn-md btn-success">Export Excel <i class="fas fa-file-excel"></i></a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Rekap Kas Kantor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="col-12">
        <?php
        // kas masuk
        $kas_masuk = mysqli_query($koneksi, "SELECT SUM(amount) as amount_in FROM transactions WHERE type='IN'");
        while($data_masuk = mysqli_fetch_array($kas_masuk, MYSQLI_ASSOC)) {
          $jumlah_kas_masuk = $data_masuk['amount_in'];
        }

        // kas keluar
        $kas_keluar = mysqli_query($koneksi, "SELECT SUM(amount) as amount_out FROM transactions WHERE type='OUT'");
        while($data_keluar = mysqli_fetch_array($kas_keluar, MYSQLI_ASSOC)) {
          $jumlah_kas_keluar = $data_keluar['amount_out'];
        }

        // total kas
        $jumlah_kas = $jumlah_kas_masuk - $jumlah_kas_keluar;
        ?>
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="card-title">Rekap Kas</h3>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kas Masuk</th>
                  <th>Kas Keluar</th>
                  <th>Total Kas</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Rp. <?= number_format($jumlah_kas_masuk); ?>,-</td>
                  <td>Rp. <?= number_format($jumlah_kas_keluar); ?>,-</td>
                  <td>Rp. <?= number_format($jumlah_kas); ?>,-</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rekap Data Kas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
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
                      $query = mysqli_query($koneksi, "SELECT * FROM transactions INNER JOIN categories ON transactions.category_id = categories.id ORDER BY transactions.id DESC");
                      while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= format_indo($row['date']); ?></td>
                        <td><?= $row['name']; ?></td>
                        <td><?= $row['type']; ?></td>
                        <td>Rp. <?= number_format($row['amount']); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'include/footer.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'include/script.php'; ?>

</body>
</html>
