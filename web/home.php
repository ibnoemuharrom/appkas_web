<?php 
// koneksi
include 'koneksi.php';
include 'include/function_tanggal.php';

session_start();

if (!isset($_SESSION['users']['id']) || empty($_SESSION['users']['id'])) {
  header('Location: index.php');
}

// tanggal hari ini
$tanggal = date('Y-m-d');

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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) --> 
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
              <a href="data_kas.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="data_kas.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="rekap_kas.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row --> 

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">

            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
                <h4 class="card-title"><i class="fa fa-calendar"></i> Kas tanggal : <?= date('d/m/Y') ?></h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                      $query = mysqli_query($koneksi, "SELECT * FROM transactions INNER JOIN categories ON transactions.category_id = categories.id WHERE date='$tanggal' ORDER BY transactions.id DESC");
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
                      <tr>
                        <?php
                        // kas masuk
                        $kas_masuk = mysqli_query($koneksi, "SELECT SUM(amount) as amount_in FROM transactions WHERE type='IN' AND date='$tanggal'");
                        while($data_masuk = mysqli_fetch_array($kas_masuk, MYSQLI_ASSOC)) {
                          $jumlah_kas_masuk = $data_masuk['amount_in'];
                        }

                        // kas keluar
                        $kas_keluar = mysqli_query($koneksi, "SELECT SUM(amount) as amount_out FROM transactions WHERE type='OUT' AND date='$tanggal'");
                        while($data_keluar = mysqli_fetch_array($kas_keluar, MYSQLI_ASSOC)) {
                          $jumlah_kas_keluar = $data_keluar['amount_out'];
                        }

                        // total kas
                        $jumlah_kas = $jumlah_kas_masuk - $jumlah_kas_keluar;
                        ?>
                        <td colspan="5" class="text-right"><b>Saldo Kas</b></td>
                        <td><b>Rp. <?= number_format($jumlah_kas); ?></b></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                Lihat Selengkapnya <a href="" class="text-decoration-none"><i class="fa fa-arrow-right"></i></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!--/.direct-chat -->

          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
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
