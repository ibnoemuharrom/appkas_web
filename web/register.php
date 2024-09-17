<?php

include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'include/head.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Registrasi</b>User</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Registrasi Pengguna</p>

      <form method="post">
        <!-- id_user -->
        <input type="hidden" name="id">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Alamat Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-info"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password1" class="form-control" placeholder="Ulangi Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="register" class="btn btn-primary btn-block">Registasi</button>
          </div>
          <!-- /.col -->
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
          header("Location: index.php?success");
        } else {
          header("Location: register.php?failed");
        }
      }

      ?>

      <div class="social-auth-links text-center mb-3">
        <p>Sudah mempunyai akun? <a href="index.php">Login.</a></p>
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include 'include/script.php'; ?>

</body>
</html>
