<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center fw-bold">
      <span class="brand-text font-weight-light font-weight-bold"><?=$_SESSION['level']?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="/travel/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block font-weight-bold" style="word-wrap: break-word; white-space: normal;"><?=$_SESSION['username_petugas']?></a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/travel/admin/index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Tabel Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/travel/admin/pages/tabel_data/data_pengguna.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna</p>
                </a>
              </li>
              <?php if ($_SESSION['level'] === 'Administrator'){?>
              <li class="nav-item">
                <a href="/travel/admin/pages/tabel_data/data_petugas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Petugas</p>
                </a>
              </li>
              <?php }?>
              <li class="nav-item">
                <a href="/travel/admin/pages/tabel_data/data_pemesanan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pemesanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/travel/admin/pages/tabel_data/data_ulasan.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Ulasan</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="/travel/admin/pages/tabel_data/galeri.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/travel/admin/pages/profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item bg-danger mt-5">
            <a href="/travel/admin/logout_petugas.php" class="nav-link text-light">
              <i class="nav-icon fas fa-solid fa-door-open"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>