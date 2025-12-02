<?php
session_start();
$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

// Koneksi ke database
$connection = mysqli_connect('localhost', 'root', '', 'book_db');

// Cek koneksi
if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    // Ambil input dari form
    $identifier = $_POST['username']; // bisa berupa username, email, atau no HP
    $password = $_POST['password'];

    // Gunakan prepared statement agar aman dari SQL Injection
    $sql = "SELECT * FROM user WHERE username = ? OR email = ? OR phone = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $identifier, $identifier, $identifier);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if ($user['status'] !== 'active') {
            $error = "Akun Anda tidak aktif. Silakan hubungi customer service.";
        } elseif (password_verify($password, $user['password'])) {
            // Set session jika login berhasil
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['success_message'] = "Login berhasil!";
            header('location: book.php');
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "User tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include "header/header.php"; ?> 
   <style>
      .alert-danger {
         color: red;
         font-size: 18px;
         margin-top: 15px;
      }
      .success-message {
         color: green;
         font-size: 20px;
         margin-bottom: 15px;
      }
   </style>
</head>
<body>
    
    <?php include "header/nav.php"; ?>

    <div class="heading" style="background:url(https://images.unsplash.com/photo-1665334327488-9f952424db9e?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat">
        <section class="booking d-flex flex-column align-items-center">
            <h1 class="heading-title">Login</h1>

            <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])): ?>
                <div class="success-message">
                    <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" class="book-form rounded col-md-8">
                <div class="flex">
                    <div class="inputBox">
                        <span>Username / Email / No HP :</span>
                        <input type="text" placeholder="enter your username" name="username" required>
                    </div>
                    <div class="inputBox">
                        <span>Password :</span>
                        <input type="password" placeholder="enter password" name="password" required>
                    </div>
                </div>
                <br>
                <div class="inputBox flex flex-column">
                    <a href="change_pw.php" style="margin-bottom: -5px;">Lupa Password?</a>
                    <a href="sign_up.php">Belum Punya Akun?</a>
                </div>
                <input type="submit" value="submit" class="btn" name="send">

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center mt-5 fs-3">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
            </form>
        </section>
    </div>

    <!-- footer -->
    <section class="footer">
        <div class="credit"> designed by <span>UTY</span> | Universitas Teknologi Yogyakarta - <?= date('Y'); ?> </div>
    </section>

    <!-- Swiper dan script -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
