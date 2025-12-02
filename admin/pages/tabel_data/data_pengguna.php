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
            <h1 class="m-0">Data Pengguna WonoTix</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pengguna</li>
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
    $sql = "SELECT id_user, username, password, email, phone, alamat, kota, status FROM user"; // Adjust 'users' to your table name
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
                        <th>Password</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Status</th>
                        <th>Actions</th>
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
                            echo "<td>" . $number++ . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>********</td>";  // Hiding password for security
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["alamat"] . "</td>";
                            echo "<td>" . $row["kota"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "<td>
                                <!-- Delete button -->
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='id_user' value='{$row['id_user']}'>
                                    <button type='submit' name='delete' class='btn btn-danger'>Hapus</button>
                                </form>
                                <!-- Activate/Deactivate button -->
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='id_user' value='{$row['id_user']}'>";
                            if ($row['status'] == 'inactive') {
                                echo "<button type='submit' name='activate' class='btn btn-success'>Aktifkan</button>";
                            } else {
                                echo "<button type='submit' name='deactivate' class='btn btn-warning'>Nonaktifkan</button>";
                            }
                            echo "  </form>
                            </td>";
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
