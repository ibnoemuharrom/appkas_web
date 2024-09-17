<?php 
// koneksi
include 'koneksi.php';

session_start();

if (!isset($_SESSION['users']['id']) || empty($_SESSION['users']['id'])) {
  header('Location: index.php');
}

// id_kas
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
            <h3>Edit Kas <i class="fa fa-edit"></i></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Kas</li>
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
                <h3 class="card-title">Edit Data Kas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
              $data_kas = mysqli_query($koneksi, "SELECT * FROM transactions INNER JOIN categories ON transactions.category_id = categories.id WHERE transactions.id='$id'");
              $data = mysqli_fetch_array($data_kas, MYSQLI_ASSOC);
              ?>
              <form method="post">
                <div class="card-body">
                  <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="category_id" id="kategori" class="form-control">
                      <option value="<?php echo $data['category_id']; ?>"><?php echo $data['name']; ?></option>
                      <option>- Edit Kategori -</option>
                      <?php
                      $kategori = mysqli_query($koneksi, "SELECT * FROM categories");
                      while($row = mysqli_fetch_array($kategori, MYSQLI_ASSOC)) {
                      ?>
                      <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                  <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Deskripsi Kas"><?php echo $data['description']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="amount">Jumlah Kas</label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Jumlah Kas" value="<?php echo $data['amount']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                      <option value="<?php echo $data['type']; ?>"><?php echo $data['type']; ?></option>
                      <option>Pilih Tipe Kas</option>
                      <option value="IN">Masuk</option>
                      <option value="OUT">Keluar</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" class="form-control" name="date" id="date" value="<?php echo $data['date']; ?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="update">Edit Data</button>
                  <a href="data_kas.php" class="btn btn-danger">Batal</a>
                </div>
              </form>
              <?php
              if (isset($_POST['update'])) {
                $query = mysqli_query($koneksi, "UPDATE transactions SET category_id='$_POST[category_id]', user_id='$_POST[user_id]', description='$_POST[description]', amount='$_POST[amount]', type='$_POST[type]', date='$_POST[date]' WHERE id='$id'");

                if ($query) {
                  echo "<script>alert('Data kas berhasil di update.');</script>";
                  echo "<script>location='data_kas.php';</script>";
                } else {
                  echo "<script>alert('Data kas gagal di update.');</script>";
                  echo "<script>location='data_kas.php?failed';</script>";
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
