<?php
// Create connection
include '../../auto_check.php';
$conn = new mysqli('localhost', 'root', '', 'book_db');


if (isset($_POST['delete'])) {
  $id = $_POST['id_petugas'];
  $conn->query("DELETE FROM petugas WHERE id_petugas = $id");
} elseif (isset($_POST['activate'])) {
  $id = $_POST['id_petugas'];
  $conn->query("UPDATE petugas SET status = 'active' WHERE id_petugas = $id");
  header("Location: data_petugas.php");
} elseif (isset($_POST['deactivate'])) {
  $id = $_POST['id_petugas'];
  $conn->query("UPDATE petugas SET status = 'inactive' WHERE id_petugas = $id");
  header("Location: data_petugas.php");
}

if (isset($_POST['add_petugas'])) {
    // Collect data from form inputs
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $level = $_POST['level'];  // Menambahkan level ke dalam data yang dikumpulkan

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new petugas data into the database
    $sql = "INSERT INTO petugas (username, password, email, phone, alamat, status, level) 
            VALUES ('$username', '$hashed_password', '$email', '$phone', '$alamat', '$status', '$level')";

    if ($conn->query($sql) === TRUE) {
        header("Location: data_petugas.php");
        echo "<script type='text/javascript'>alert('Berhasil Menambahkan Data!');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}


if (isset($_POST['update_petugas'])) {
    $id_petugas = $_POST['id_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $level = $_POST['level'];  // Menambahkan level ke dalam form

    // Update password jika diisi
    $setPassword = '';
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $setPassword = ", password='$hashed_password'";
    }

    $sql = "UPDATE petugas SET 
                username='$username',
                email='$email',
                phone='$phone',
                alamat='$alamat',
                level='$level'  
                $setPassword
            WHERE id_petugas=$id_petugas";

    if ($conn->query($sql) === TRUE) {
        header("Location: data_petugas.php"); // Redirect ke halaman yang sama atau lainnya
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include "../layout/header.php";
  ?>
  <style>
  table {
    table-layout: fixed; /* Membuat lebar tabel tetap */
    width: 100%; /* Atur lebar tabel agar memenuhi kontainer */
  }

  th, td {
    overflow: hidden; /* Menyembunyikan teks yang melampaui */
    text-overflow: ellipsis; /* Menambahkan titik-titik jika teks terlalu panjang */
    white-space: nowrap; /* Mencegah teks memanjang ke baris berikutnya */
  }

  th:nth-child(1), td:nth-child(1) {
    width: 5%; /* Kolom pertama (No) */
  }

  th:nth-child(2), td:nth-child(2) {
    width: 15%; /* Kolom kedua (Username) */
  }

  th:nth-child(3), td:nth-child(3) {
    width: 10%; /* Kolom Password */
  }

  th:nth-child(4), td:nth-child(4) {
    width: 20%; /* Kolom Email */
  }

  th:nth-child(5), td:nth-child(5) {
    width: 15%; /* Kolom Phone */
  }

  th:nth-child(6), td:nth-child(6) {
    width: 20%; /* Kolom Alamat */
  }

  th:nth-child(7), td:nth-child(7) {
    width: 10%; /* Kolom Level */
  }

  th:nth-child(8), td:nth-child(8) {
    width: 15%; /* Kolom Actions */
  }
</style>

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
            <h1 class="m-0">Data Petugas WonoTix</h1>
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
   
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select data
    $sql = "SELECT * FROM petugas";
    $result = $conn->query($sql);
    ?>



    <!-- Main content -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
        <button type="button" data-toggle="modal" data-target="#tambahPetugasModal" 
          class="float-right rounded bg-success border no-border p-2">Tambah Data Petugas +</button>
      </div>

      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped" style="table-layout: fixed; width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Password</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Alamat</th>
              <th>level</th>
              <th class="actions-column">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($result->num_rows > 0) {
              $nomor = 1;
              while ($row = $result->fetch_assoc()) {
                $level = $row['level'];
                echo "<tr>";
                echo "<td>{$nomor}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>****</td>"; // Hiding password for security
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['alamat']}</td>";
                echo "<td>{$level}</td>";
                echo "<td>
                  <form method='POST' style='display:inline;'>
                    <input type='hidden' name='id_petugas' value='{$row['id_petugas']}'>
                    <button type='submit' name='delete' class='btn btn-danger'>Hapus</button>
                  </form>
                  <button type='button' class='btn btn-warning text-light' 
                    data-toggle='modal' data-target='#editModal' 
                    data-id='{$row['id_petugas']}' 
                    data-username='{$row['username']}' 
                    data-email='{$row['email']}' 
                    data-phone='{$row['phone']}' 
                    data-alamat='{$row['alamat']}'>
                    Update
                  </button>
                  <form method='POST' style='display:inline;'>
                    <input type='hidden' name='id_petugas' value='{$row['id_petugas']}'>
                    " . ($row['status'] == 'inactive' ?
                      "<button type='submit' name='activate' class='btn btn-success'>Aktifkan</button>" :
                      "<button type='submit' name='deactivate' class='btn btn-info'>Nonaktifkan</button>") .
                    "</form>
                </td>";
                echo "</tr>";
                $nomor++;
              }
            } else {
              echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->                
  </div>

  <!-- Modal Form for Adding a New Petugas -->
  <div id="tambahPetugasModal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form method="POST" autocomplete="off">
                  <div class="modal-header">
                      <h5 class="modal-title">Tambah Data Petugas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>Nama Petugas</p>
                      <input type="text" name="username" placeholder="Username" required class="form-control mb-2">

                      <p>Password</p>
                      <input type="password" name="password" placeholder="Password" autocomplete="off" required class="form-control mb-2">

                      <p>Email</p>
                      <input type="email" name="email" placeholder="Email" autocomplete="off" required class="form-control mb-2">

                      <p>No.Telephone</p>
                      <input type="text" name="phone" placeholder="Phone" autocomplete="off" required class="form-control mb-2">

                      <p>Alamat</p>
                      <input type="text" name="alamat" placeholder="Alamat" autocomplete="off" required class="form-control mb-2">

                      <p>Level</p>
                      <select name="level" class="form-control" autocomplete="off">
                          <option value="" disabled selected>Pilih Level</option>  <!-- Placeholder -->
                          <option value="administrator">administrator</option>
                          <option value="petugas">petugas</option>
                      </select>

                      <p>Status</p>
                      <select name="status" class="form-control" autocomplete="off">
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                      </select>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="add_petugas" class="btn btn-primary">Tambah</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Modal Form for Editing Petugas -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <form method="POST">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Edit Data Petugas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_petugas" id="edit-id">
                    <div class="form-group">
                        <label>Nama Pengguna</label>
                        <input type="text" name="username" id="edit-username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No.Telephone</label>
                        <input type="text" name="phone" id="edit-phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" id="edit-alamat" class="form-control" required>
                    </div>                      
                    <p>Level</p>
                    <select name="level" class="form-control" autocomplete="off">
                        <option value="" disabled <?php echo $level == "" ? "selected" : ""; ?>>Pilih Level</option>  <!-- Placeholder -->
                        <option value="administrator" <?php echo $level == "administrator" ? "selected" : ""; ?>>Administrator</option>
                        <option value="petugas" <?php echo $level == "petugas" ? "selected" : ""; ?>>Petugas</option>
                    </select>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="update_petugas" class="btn btn-primary">Update</button>
                  </div>
              </div>
          </form>
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
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });

    $('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var username = button.data('username');
    var email = button.data('email');
    var phone = button.data('phone');
    var alamat = button.data('alamat');
    var level = button.data('level');  // Dapatkan level dari data-id

    var modal = $(this);
    modal.find('#edit-id').val(id);
    modal.find('#edit-username').val(username);
    modal.find('#edit-email').val(email);
    modal.find('#edit-phone').val(phone);
    modal.find('#edit-alamat').val(alamat);
    modal.find("select[name='level']").val(level); // Menetapkan nilai level pada dropdown
    });
</script>
</body>
</html>
