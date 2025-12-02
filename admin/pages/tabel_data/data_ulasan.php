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
            <h1 class="m-0">Data Ulasan WonoTix</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Ulasan</li>
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

    // Handle delete and status update actions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['delete'])) {
          $id = $_POST['id_user'];
          $conn->query("DELETE FROM user WHERE id_user = $id");
      } elseif (isset($_POST['activate'])) {
          $id = $_POST['id_user'];
          $conn->query("UPDATE user SET status = 'active' WHERE id_user = $id");
      } elseif (isset($_POST['deactivate'])) {
          $id = $_POST['id_user'];
          $conn->query("UPDATE user SET status = 'inactive' WHERE id_user = $id");
      }
    }

    // SQL query to select data
    $sql = "SELECT id_ulasan, username, date,komentar,rating FROM ulasan"; // Adjust 'users' to your table name
    $result = $conn->query($sql);
    ?>



    <!-- Main content -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Tanggal</th>
                        <th>Komentar</th>
                        <th>Rating</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                     $nomor = 1;
                    // Check if we have results
                    if ($result->num_rows > 0) {
                        // Loop through each row and display it in the table
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>". $nomor++ ."</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" .$row["date"] .  "</td>";  // Hiding password for security
                            echo "<td>" . $row["komentar"] . "</td>";
                            echo "<td>" . $row["rating"] . "</td>";
                            // echo "<td>
                            //     <!-- Tanggapan button -->
                            //     <form method='POST' style='display:inline;'>
                            //         <input type='hidden' name='id_ulasan' value='{$row['id_ulasan']}'>
                            //         <button type='submit' name='delete' class='btn btn-warning'>Tanggapi</button>
                            //     </form>
                            // </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>    
    </div> 
    <!-- /.card-body -->                
  </div>
  <!-- Modal Tanggapan -->
  <div class="modal fade" id="modalTanggapan" tabindex="-1" role="dialog" aria-labelledby="modalTanggapanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTanggapanLabel">Tanggapi Ulasan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" id="formTanggapan">
          <div class="modal-body">
            <div class="form-group">
              <label for="tanggapan">Tanggapan</label>
              <textarea class="form-control" id="tanggapan" name="tanggapan" rows="4" required></textarea>
            </div>
            <input type="hidden" id="idUlasan" name="id_ulasan">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" name="submitTanggapan" class="btn btn-primary">Kirim Tanggapan</button>
          </div>
        </form>
      </div>
    </div>
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
