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
            <h2>Kategori</h2>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Kategori</li>
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
                <h3 class="card-title">Input Data Kategori</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <input type="hidden" name="id">
                  <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Kategori">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="save" class="btn btn-primary">Simpan Data</button>
                  <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                </div>
              </div>
            </form>

            <?php
              if (isset($_POST['save'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];

                // cek category name
                $cek = mysqli_query($koneksi, "SELECT name FROM categories WHERE name = '$name'");
                if (mysqli_fetch_assoc($cek)) {
                  echo "<script>alert('Nama kategori sudah terdaftar.')</script>";
                  echo "<script>location='kategori.php';</script>";
                  return false;
                }

                // tambah data
                $sql = mysqli_query($koneksi, "INSERT INTO categories VALUES('$id','$name')");
                if ($sql) {
                  echo "<script>alert('Data kategori berhasil di input.');</script>";
                  echo "<script>location='kategori.php';</script>";
                } else {
                  echo "<script>alert('Data kategori gagal di input.');</script>";
                  echo "<script>location='kategori.php';</script>";
                }
              }

              ?>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kategori</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $data = mysqli_query($koneksi, "SELECT * FROM categories");
                      while($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) { ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['name']; ?></td>
                          <td>
                            <a href="edit_kategori.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                            <a href="hapus_kategori.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data?');"><i class="fas fa-trash"></i></a>
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
