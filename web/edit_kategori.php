<?php 
// koneksi
include 'koneksi.php';

session_start();

if (!isset($_SESSION['users']['id']) || empty($_SESSION['users']['id'])) {
  header('Location: index.php');
}

// 
$id = $_GET['id'];

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
            <h2>Kategori</h2>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Data Kategori</li>
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
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Edit Data Kategori</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              $kategori = mysqli_query($koneksi, "SELECT * FROM categories WHERE id='$id'");
              $data = mysqli_fetch_array($kategori, MYSQLI_ASSOC);
              ?>
              <form method="post">
                <div class="card-body">
                  <input type="hidden" name="id" value="<?= $data['id']; ?>">
                  <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" value="<?= $data['name']; ?>">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-success">Edit Data</button>
                  <a href="kategori.php" class="btn btn-danger">Batal</a>
                </div>
              </div>
            </form>

            <?php
              if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];

                // cek category name
                $cek = mysqli_query($koneksi, "SELECT name FROM categories WHERE name = '$name'");
                if (mysqli_fetch_assoc($cek)) {
                  echo "<script>alert('Nama kategori sudah terdaftar.')</script>";
                  echo "<script>location='kategori.php';</script>";
                  return false;
                }

                // edit data
                $sql = mysqli_query($koneksi, "UPDATE categories SET id='$id', name='$name' WHERE id='$id'");
                if ($sql) {
                  echo "<script>alert('Data kategori berhasil di edit.');</script>";
                  echo "<script>location='kategori.php';</script>";
                } else {
                  echo "<script>alert('Data kategori gagal di edit.');</script>";
                  echo "<script>location='kategori.php';</script>";
                }
              }

              ?>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
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
