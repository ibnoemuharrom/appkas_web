<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="assets/dist/img/logo.png" alt="" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">APP KAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="home.php" class="d-block"><?php echo $_SESSION['users']['name']; ?></a>
          <small class="badge badge-success"><i class="far fa-user"></i> Pengguna</small>
        </div>
      </div>

      <!-- Sidebar Menu admin -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="home.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-list"></i>
              <p>
                Kas Kantor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="data_kas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="rekap_kas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Kas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="kategori.php" class="nav-link">
              <i class="nav-icon fas fa-bookmark"></i>
              <p>
                Kategori Kas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="data_user.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link" onclick='return confirm("Apakah yakin ingin keluar?");'>
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>

    </div>
    <!-- /.sidebar -->
  </aside>