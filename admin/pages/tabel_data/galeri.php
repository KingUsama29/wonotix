<?php
include '../../auto_check.php';
ob_start();
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'book_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tangani aksi delete dan update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Hapus data berdasarkan ID
        $id = $_POST['id_galeri'];
        $conn->query("DELETE FROM galeri WHERE id_galeri = $id");
    } elseif (isset($_POST['update'])) {
        // Update data berdasarkan ID
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $caption = $_POST['caption'];
        $errorMsg = ""; // Variabel untuk menyimpan pesan error

        // Proses upload foto baru jika ada
        $foto = "";
        if (!empty($_FILES['foto']['name'])) {
            $targetDir = "../../dist/galeri/"; // Folder untuk menyimpan foto
            $fotoName = basename($_FILES['foto']['name']);
            $targetFilePath = $targetDir . $fotoName;

            // Validasi tipe file
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFilePath)) {
                    $foto = $fotoName; // Nama file untuk disimpan di database
                } else {
                    $errorMsg = "Error saat mengunggah foto.";
                }
            } else {
                $errorMsg = "Format file tidak valid. Harap unggah file JPG, JPEG, PNG, atau GIF.";
            }
        }

        if (!empty($errorMsg)) {
            // Redirect kembali dengan pesan error
            header("Location: galeri.php?error=" . urlencode($errorMsg));
            exit;
        }

        // Jika ada foto baru, update foto juga
        if (!empty($foto)) {
            $query = "UPDATE galeri SET judul=?, caption=?, foto=? WHERE id_galeri=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $judul, $caption, $foto, $id);
        } else {
            // Jika tidak ada foto baru, update hanya judul dan caption
            $query = "UPDATE galeri SET judul=?, caption=? WHERE id_galeri=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $judul, $caption, $id);
        }

        if ($stmt->execute()) {
            echo '<script>
                alert("Data Berhasil Di Perbarui");
                window.location.href = "galeri.php";
            </script>';
            exit;
        } else {
            echo '<script>
                alert("Error: ' . addslashes($stmt->error) . '");
                window.location.href = "galeri.php?error=' . urlencode($stmt->error) . '";
            </script>';
            exit;
        }
    } elseif (isset($_POST['tambah_galeri'])) {
        // Tambah Data Baru
        $judul = $_POST['judul'];
        $caption = $_POST['caption'];
        $errorMsg = "";

        // Upload foto
        $foto = "";
        $targetDir = "../../dist/galeri/";
        if (!empty($_FILES['foto']['name'])) {
            $fotoName = basename($_FILES['foto']['name']);
            $targetFilePath = $targetDir . $fotoName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFilePath)) {
                    $foto = $fotoName;
                } else {
                    $errorMsg = "Gagal mengunggah foto.";
                }
            } else {
                $errorMsg = "Format file tidak valid!";
            }
        }

        if (empty($errorMsg)) {
            $stmt = $conn->prepare("INSERT INTO galeri (judul, caption, foto) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $judul, $caption, $foto);
            if ($stmt->execute()) {
                echo '<script>
                    alert("Data Berhasil Ditambahkan");
                    window.location.href = "galeri.php";
                </script>';
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "<script>alert('$errorMsg');</script>";
        }
    }
}

// Ambil data galeri
$sql = "SELECT * FROM galeri";
$result = $conn->query($sql);
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
            <h1 class="m-0">Galeri WonoTix</h1>
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
    <!-- Main content -->
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">Data Galeri</h3>
          <button type="button" data-toggle="modal" data-target="#tambahGaleriModal" 
          class="float-right rounded bg-success border no-border p-2">Tambah Galeri +</button>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Foto</th>
                      <th>Judul</th>
                      <th>Caption</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  $nomor = 1;
                  // Check if there are results
                  if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $nomor++ . "</td>";
                          echo "<td>
                                  <img src='/travel/admin/dist/galeri/" . htmlspecialchars($row["foto"]) . "' 
                                      alt='Foto Galeri' 
                                      style='width:100px;height:auto;'>
                                </td>";
                          echo "<td>" . htmlspecialchars($row["judul"]) . "</td>";
                          echo "<td>" . htmlspecialchars($row["caption"]) . "</td>";
                          echo "<td>
                                  <!-- Delete Button -->
                                  <form method='POST' style='display:inline;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>
                                      <input type='hidden' name='id_galeri' value='" . htmlspecialchars($row["id_galeri"]) . "'>
                                      <button type='submit' name='delete' class='btn btn-danger btn-sm p-2 px-3'>
                                          Hapus
                                      </button>
                                  </form>
                                  <!-- Update Button -->
                                  <button type='button' class='btn btn-warning text-light' 
                                    data-toggle='modal' 
                                    data-target='#editModal' 
                                    data-id='{$row['id_galeri']}' 
                                    data-foto='/travel/admin/dist/galeri/{$row['foto']}' 
                                    data-judul='{$row['judul']}' 
                                    data-caption='{$row['caption']}'> 
                                    Update
                                  </button>
                                </td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='5'>Tidak ada data yang ditemukan.</td></tr>";
                  }
                  ?>
              </tbody>
          </table>
      </div>
    </div>
    <!-- /.card-body -->                
  </div>
  <!-- Modal Edit Data -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Galeri</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Tampilkan Foto -->
          <img id="edit-foto" src="" alt="Foto Galeri" style="width: 100%; height: auto; margin-bottom: 15px;">

          <!-- Form Update -->
          <form id="updateForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="edit-judul">Judul</label>
              <input type="text" class="form-control" id="edit-judul" name="judul">
            </div>
            <div class="form-group">
              <label for="edit-caption">Caption</label>
              <textarea class="form-control" id="edit-caption" name="caption"></textarea>
            </div>
            <div class="form-group">
              <label for="edit-foto-upload">Foto</label>
              <input type="file" class="form-control" id="edit-foto-upload" name="foto">
            </div>
            <input type="hidden" id="edit-id" name="id">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="update" form="updateForm" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data Galeri -->
  <div id="tambahGaleriModal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form id="tambahGaleriForm" method="POST" enctype="multipart/form-data">
                  <div class="modal-header">
                      <h5 class="modal-title">Tambah Data Galeri</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <!-- Judul -->
                      <div class="form-group">
                          <label for="judul">Judul</label>
                          <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul" required>
                      </div>
                      <!-- Caption -->
                      <div class="form-group">
                          <label for="caption">Caption</label>
                          <textarea class="form-control" id="caption" name="caption" rows="3" placeholder="Masukkan Caption" required></textarea>
                      </div>
                      <!-- Upload Foto -->
                      <div class="form-group">
                          <label for="foto">Foto</label>
                          <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .jpeg, .png, .gif" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="tambah_galeri" class="btn btn-primary">Tambah</button>
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
    // Konfigurasi DataTable
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
      "responsive": true,
    });

    // Tambahkan kode untuk mengisi modal update
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button yang memicu modal
      var id = button.data('id');
      var foto = button.data('foto'); // Ambil URL foto
      var judul = button.data('judul');
      var caption = button.data('caption');

      // Isi nilai field di dalam modal
      var modal = $(this);
      modal.find('#edit-id').val(id);
      modal.find('#edit-judul').val(judul);
      modal.find('#edit-caption').val(caption);

      // Tampilkan foto di dalam modal
      modal.find('#edit-foto').attr('src', foto);
    });


  });
</script>


</body>
</html>
