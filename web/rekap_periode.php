<?php 
// koneksi
include 'koneksi.php';

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
            <a href="rekap_kas.php" class="btn btn-md btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-calendar"></i> Rekap Periode Kas</h3>
              </div>
              <form action="print_periode.php" method="post" enctype="multipart/form-data" target="_blank">
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="date_1" name="date_1">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="date_2" name="date_2">
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-md btn-info" name="print" target="_blank">Cetak Periode <i class="fa fa-file-pdf"></i></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
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
