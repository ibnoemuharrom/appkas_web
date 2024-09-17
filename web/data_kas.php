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
            <a href="input_kas.php" class="btn btn-md btn-primary">Input Data Kas <i class="fas fa-edit"></i></a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Kas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <?php
              $kas_masuk = mysqli_query($koneksi, "SELECT SUM(amount) as amount_in FROM transactions WHERE type='IN'");
              while($data_masuk = mysqli_fetch_array($kas_masuk, MYSQLI_ASSOC)) {
                $jumlah_kas_masuk = $data_masuk['amount_in'];
              }
              ?>
              <div class="inner">
                <h4>Rp. <?= number_format($jumlah_kas_masuk); ?>,- </h4>
                <p>Jumlah Kas Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <?php
              $kas_keluar = mysqli_query($koneksi, "SELECT SUM(amount) as amount_out FROM transactions WHERE type='OUT'");
              while($data_keluar = mysqli_fetch_array($kas_keluar, MYSQLI_ASSOC)) {
                $jumlah_kas_keluar = $data_keluar['amount_out'];
              }
              ?>
              <div class="inner">
                <h4>Rp. <?= number_format($jumlah_kas_keluar); ?>,- </h4>
                <p>Jumlah Kas Keluar</p>
              </div>
              <div class="icon">
               <i class="fas fa-list-ul"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <?php
              $jumlah_kas = $jumlah_kas_masuk - $jumlah_kas_keluar;
              ?>
              <div class="inner">
                <h4>Rp. <?= number_format($jumlah_kas); ?>,-</h4>
                <p>Saldo Kas</p>
              </div>
              <div class="icon">
                <i class="fas fa-bars"></i>
              </div>
            </div>
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
                <h3 class="card-title">Tabel Data Kas</h3>
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
                        <th>Type</th>
                        <th>Jumlah</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $query = mysqli_query($koneksi, "SELECT * FROM transactions ORDER BY id DESC");
                      while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= format_indo($row['date']); ?></td>
                        <td><?= $row['type']; ?></td>
                        <td>Rp. <?= number_format($row['amount']); ?></td>
                        <td>
                          <a href="edit_kas.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                          <a href="hapus_kas.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick='return confirm("Apakah yakin ingin menghapus data?")'><i class="fas fa-trash"></i></a>
                        </td>
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
