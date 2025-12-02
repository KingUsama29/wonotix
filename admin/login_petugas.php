<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'book_db');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Ambil data petugas berdasarkan telepon
    $sql = "SELECT * FROM petugas WHERE phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Cek apakah akun aktif
        if ($row['status'] !== 'active') {
            $error = "Akun Anda belum aktif. Hubungi admin untuk aktivasi.";
        } 
        // Cek apakah password sesuai
        elseif (password_verify($password, $row['password'])) {
            // Set session untuk login
            session_start();
            $_SESSION['id_petugas'] = $row['id_petugas'];
            $_SESSION['username_petugas'] = $row['username'];
            $_SESSION['level'] = $row['level']; // Tambahkan role jika perlu

            // Redirect ke halaman dashboard
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Nomor telepon tidak ditemukan.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Petugas/Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1"><b>Login</b> Petugas</p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Pastikan Akun Anda Telah Diaktifkan Admin</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="Telepon" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <p class="mb-1">
                    <a href="change_pw.php">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
