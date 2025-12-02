<?php 
include '../auto_check.php';
$conn = new mysqli('localhost', 'root', '', 'book_db');

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if (!isset($_SESSION['id_petugas'])) {
    header('Location: login.php');
    exit();
}
$id_petugas = $_SESSION['id_petugas'];

// Ambil data pengguna berdasarkan session
$stmt = $conn->prepare("SELECT * FROM petugas WHERE id_petugas = ?");
$stmt->bind_param("i", $id_petugas);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

// Periksa jika metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $alamat = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);

    // Validasi data input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: profile.php?status=invalid_email");
        exit();
    }

    // Query untuk update data
    $stmt = $conn->prepare("UPDATE petugas SET email = ?, phone = ?, alamat = ? WHERE id_petugas = ?");
    $stmt->bind_param("sssi", $email, $phone, $alamat, $id_petugas);

    if ($stmt->execute()) {
        header("Location: profile.php?status=success");
    } else {
        header("Location: profile.php?status=error");
    }
    $stmt->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "layout/header.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/travel/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include "layout/navbar.php"; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include "layout/sidebar.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profil Pengguna</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profil</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                    <div class="card-body box-profile">

                        <h3 class="profile-username text-center"><?php echo htmlspecialchars($data['username']); ?></h3>

                        <p class="text-muted text-center"><?php echo ucfirst(htmlspecialchars($data['level'])); ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right"><?php echo htmlspecialchars($data['email']); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a class="float-right"><?php echo htmlspecialchars($data['phone']); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Alamat</b> <a class="float-right"><?php echo htmlspecialchars($data['alamat']); ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <a class="float-right"><?php echo ucfirst(htmlspecialchars($data['status'])); ?></a>
                        </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalUpdateProfil"><b>Edit Profil</b></a>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal Update Profil -->
    <div class="modal fade" id="modalUpdateProfil" tabindex="-1" role="dialog" aria-labelledby="modalUpdateProfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form action="" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="modalUpdateProfilLabel">Edit Profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <!-- Input for Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
            </div>
            <!-- Input for Phone -->
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" name="phone" class="form-control" id="phone" value="<?php echo htmlspecialchars($data['phone']); ?>" required>
            </div>
            <!-- Input for Address -->
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <!-- /.content-wrapper -->
    <?php include "layout/footer.php"; ?>
</body>
</html>
