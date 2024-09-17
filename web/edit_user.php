<?php 
// koneksi
include 'koneksi.php';

session_start();

if (!isset($_SESSION['users']['id']) || empty($_SESSION['users']['id'])) {
  header('Location: index.php');
}

// id
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
            <h3>Edit User <i class="fa fa-user"></i></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
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
                <h3 class="card-title">Edit Data User</h3>
              </div>
              <!-- /.card-header -->
              <?php
              $user = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
              $data = mysqli_fetch_array($user, MYSQLI_ASSOC);
              ?>
              <form method="post">
                <div class="card-body">
                  <input type="hidden" name="id" value="<?= $data['id']; ?>">
                  <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap" value="<?= $data['name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Alamat email" value="<?= $data['email']; ?>">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-success">Update Data</button>
                  <a href="data_user.php" class="btn btn-danger">Batal</a>
                </div>
              </div>
            </form>

            <?php
            if (isset($_POST['update'])) {

              $sql = mysqli_query($koneksi, "UPDATE users SET id='$_POST[id]', name='$_POST[name]', email='$_POST[email]' WHERE id='$id'");

              $_SESSION['user']['name'] = $_POST['name'];
              $_SESSION['user']['email'] = $_POST['email'];

              if ($sql) {
                echo "<script>alert('Data user berhasil di update.');</script>";
                echo "<script>location='data_user.php';</script>";
              } else {
                echo "<script>alert('Data user gagal di update!');</script>";
                echo "<script>location='data_user.php?failed';</script>";
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
