<?php

include '../../auto_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "../layout/header.php";
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php
    include "../layout/navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include "../layout/sidebar.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pemesanan WonoTix</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pemesanan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <?php
  // Create connection
  $conn = new mysqli('localhost', 'root', '', 'book_db');

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Ambil parameter filter dari URL
  $status_filter = isset($_GET['filter']) ? $_GET['filter'] : null;

  // Query default
  $sql = "SELECT id_payment, order_id, nama_pemesan, email, telepon, tamu, tanggal_kunjungan, total_harga, tanggal_pembayaran, status FROM payments";

  // Jika ada filter status, tambahkan kondisi WHERE
  if ($status_filter === 'success') {
      $sql .= " WHERE status = 'success'";
  }

  $result = $conn->query($sql);
  ?>

    <!-- Main content -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <?php echo $status_filter === 'success' ? 'Data Pemesanan (Success)' : 'Data Pemesanan (Semua Status)'; ?>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Nama Pemesan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tamu</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pembayaran</th>
                        <!-- <th>Status</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php
                // Check if we have results
                if ($result->num_rows > 0) {
                    // Loop through each row and display it in the table
                    $number = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>". $number++ ."</td>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["nama_pemesan"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["telepon"] . "</td>";
                        echo "<td>" . $row["tamu"] . "</td>";
                        echo "<td>" . $row["tanggal_kunjungan"] . "</td>";
                        echo "<td>Rp " . number_format($row["total_harga"], 0, ',', '.') . "</td>";
                        echo "<td>" . $row["tanggal_pembayaran"] . "</td>";

                        // // Tentukan kelas Bootstrap berdasarkan status
                        // $statusClass = '';
                        // switch ($row['status']) {
                        //     case 'success':
                        //         $statusClass = 'bg-success text-white';
                        //         break;
                        //     case 'pending':
                        //         $statusClass = 'bg-primary text-white';
                        //         break;
                        //     case 'failed':
                        //         $statusClass = 'bg-danger text-white';
                        //         break;
                        //     default:
                        //         $statusClass = 'bg-secondary text-white'; // Default class
                        //         break;
                        // }

                        // // Kolom status dengan warna dan efek
                        // echo "<td>
                        //         <span class='$statusClass px-3 py-1 d-inline-block' style='opacity: 0.7; border-radius: 16px;'>
                        //             " . ucfirst($row["status"]) . "
                        //         </span>
                        //       </td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No data found</td></tr>";
                }
                ?>
            </tbody>
            </table>
        </div>    
    </div> 
    <!-- /.card-body -->                
  </div>
  <!-- /.content -->
  <!-- /.content-wrapper -->
  <?php
    include "../layout/footer.php";
  ?>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
