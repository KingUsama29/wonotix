<?php 
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = ''; // Sesuaikan dengan password database Anda
$database = 'book_db';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

include 'auto_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "pages/layout/header.php";
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php
    include "pages/layout/navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include "pages/layout/sidebar.php";
   ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Fetch Data from Database -->
        <?php
        // Query untuk total pengguna
        $query_total_user = "SELECT COUNT(*) AS total_user FROM user";
        $result_user = mysqli_query($conn, $query_total_user);
        $data_user = mysqli_fetch_assoc($result_user);
        $total_user = $data_user['total_user'];

        // Query untuk total petugas
        $query_total_petugas = "SELECT COUNT(*) AS total_petugas FROM petugas";
        $result_petugas = mysqli_query($conn, $query_total_petugas);
        $data_petugas = mysqli_fetch_assoc($result_petugas);
        $total_petugas = $data_petugas['total_petugas'];

        // Query untuk total pemesanan tiket dengan status success
        $query_total_pemesanan = "SELECT COUNT(*) AS total_pemesanan FROM payments";
        $result_pemesanan = mysqli_query($conn, $query_total_pemesanan);
        $data_pemesanan = mysqli_fetch_assoc($result_pemesanan);
        $total_pemesanan = $data_pemesanan['total_pemesanan'];

        // Query untuk total ulasan
        $query_total_ulasan = "SELECT COUNT(*) AS total_ulasan FROM ulasan";
        $result_ulasan = mysqli_query($conn, $query_total_ulasan);
        $data_ulasan = mysqli_fetch_assoc($result_ulasan);
        $total_ulasan = $data_ulasan['total_ulasan'];

        // Query untuk total uang masuk
        $query_total_income = "SELECT SUM(total_harga) AS total_income FROM payments WHERE status = 'success'";
        $result_income = mysqli_query($conn, $query_total_income);
        $data_income = mysqli_fetch_assoc($result_income);
        $total_income = $data_income['total_income'] ?: 0; // Jika NULL, maka 0
        ?>

        <!-- Small boxes (Stat box) -->
        <?php
        // Query untuk rata-rata rating
        $query_avg_rating = "SELECT AVG(rating) AS avg_rating FROM ulasan";
        $result_rating = mysqli_query($conn, $query_avg_rating);
        $data_rating = mysqli_fetch_assoc($result_rating);
        $avg_rating = number_format($data_rating['avg_rating'], 2); // Membulatkan ke 2 desimal
        ?>

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $total_user; ?></h3>
                <p>Total Pengguna</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i> <!-- Ikon untuk pengguna -->
              </div>
              <a href="/travel/admin/pages/tabel_data/data_pengguna.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $total_petugas; ?></h3>
                <p>Total Petugas</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-tie"></i> <!-- Ikon untuk petugas -->
              </div>
              <?php if ($_SESSION['level'] === 'Administrator'){?>
                <a href="/travel/admin/pages/tabel_data/data_petugas.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              <?php }else{?>
                <a href="#" class="small-box-footer">Akses Tidak Diizinkan<i class="ml-2 fas fa-times-circle"></i></a>
              <?php }?>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $total_pemesanan; ?></h3>
                <p>Total Pemesanan Tiket</p>
              </div>
              <div class="icon">
                <i class="fas fa-ticket-alt"></i> <!-- Ikon untuk tiket -->
              </div>
              <a href="/travel/admin/pages/tabel_data/data_pemesanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $avg_rating; ?></h3>
                <p>Rata-Rata Rating</p>
              </div>
              <div class="icon">
                <i class="fas fa-comments"></i> <!-- Ikon untuk rating -->
              </div>
              <a href="/travel/admin/pages/tabel_data/data_ulasan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include "pages/layout/footer.php";
  ?>
</body>
</html>
