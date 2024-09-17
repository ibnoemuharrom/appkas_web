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
            <h3>Input Data Kas <i class="fa fa-edit"></i></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Input Data Kas</li>
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
                <h3 class="card-title">Input Data Kas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <input type="hidden" name="id">
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="category_id" id="kategori" class="form-control">
                      <option>Pilih Kategori</option>
                      <?php
                      $kategori = mysqli_query($koneksi, "SELECT * FROM categories");
                      while($row = mysqli_fetch_array($kategori, MYSQLI_ASSOC)) {
                      ?>
                      <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $_SESSION['users']['id']; ?>">
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Deskripsi Kas"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="amount">Jumlah Kas</label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Jumlah Kas">
                  </div>
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                      <option>Pilih Tipe Kas</option>
                      <option value="IN">Masuk</option>
                      <option value="OUT">Keluar</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" class="form-control" name="date" id="date">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="save">Simpan Data</button>
                  <a href="data_kas.php" class="btn btn-danger">Kembali</a>
                </div>
              </form>
              <?php
              if (isset($_POST['save'])) {
                $query = mysqli_query($koneksi, "INSERT INTO transactions(id,category_id,user_id,description,amount,type,date)VALUES('$_POST[id]','$_POST[category_id]','$_POST[user_id]','$_POST[description]','$_POST[amount]','$_POST[type]','$_POST[date]')");

                if ($query) {
                  echo "<script>alert('Data kas berhasil disimpan.');</script>";
                  echo "<script>location='data_kas.php';</script>";
                } else {
                  echo "<script>alert('Data kas gagal disimpan.');</script>";
                  echo "<script>location='input_kas.php?failed';</script>";
                }
              }

              ?>
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
