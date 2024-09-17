<?php 

include 'koneksi.php';

session_start();

if (isset($_SESSION['users']['id']) || !empty($_SESSION['users']['id'])) {
  header('Location: home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'include/head.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Login</b>User</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masukan Email dan Password Anda</p>

      <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success">
          <button class="close" data-dismiss="alert" aria-label="close">×</button>
          Registrasi Berhasil, Silahkan Login.
        </div>
      <?php } ?>

      <?php if (isset($_GET['failed'])) { ?>
        <div class="alert alert-danger alert-dismissable">
          <button class="close" data-dismiss="alert" aria-label="close">×</button>
          Login gagal, periksa data login anda.
        </div>
      <?php } ?>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Alamat Email" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php
      if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
        $cek = mysqli_num_rows($query);
        $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

        if ($cek === 1) {
            if (password_verify($password, $row['password'])) {
            $_SESSION['users']['id'] = $row['id'];
            $_SESSION['users']['name'] = $row['name'];
            $_SESSION['users']['email'] = $row['email'];

            header('Location: home.php');
          } else {
            header('Location: index.php?failed');
          }

        }

      }

      ?>

      <div class="social-auth-links text-center mb-3">
        <p>Belum mempunyai akun? <a href="register.php">Registrasi.</a></p>
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
