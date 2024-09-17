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
            <h3>Input User <i class="fa fa-user"></i></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Input User</li>
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
                <h3 class="card-title">Input Data User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <input type="hidden" name="id">
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
                  </div>
                  <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Alamat Email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="password1">Ulangi Password</label>
                    <input type="password" class="form-control" name="password1" id="password1" placeholder="Ulangi Password">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="register" class="btn btn-primary">Simpan Data</button>
                  <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                </div>
              </div>
            </form>

            <?php
              if (isset($_POST['register'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = mysqli_real_escape_string($koneksi, $_POST['password']);
                $password1 = mysqli_real_escape_string($koneksi, $_POST['password1']);

                $date = date('Y-m-d');

                // cek password
                if ($password !== $password1) {
                  echo "<script>alert('Password tidak sesuai.')</script>";
                  return false;
                }

                // cek email
                $cek = mysqli_query($koneksi, "SELECT email FROM users WHERE email = '$email'");
                if (mysqli_fetch_assoc($cek)) {
                  echo "<script>alert('Email sudah terdaftar.')</script>";
                  return false;
                }

                // enkripsi password
                $password = password_hash($password, PASSWORD_DEFAULT);

                // tambah data
                $sql = mysqli_query($koneksi, "INSERT INTO users VALUES('$id','$name','$email','$password','$date')");
                if ($sql) {
                  echo "<script>alert('Data user berhasil di input.');</script>";
                  echo "<script>location='data_user.php';</script>";
                } else {
                  echo "<script>alert('Data user gagal di input.');</script>";
                  echo "<script>location='input_user.php';</script>";
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
