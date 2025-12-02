<?php
session_start();

// Koneksi ke database
$connection = mysqli_connect('localhost', 'root', '', 'book_db');

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['password1']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $location = htmlspecialchars($_POST['location']);

    // Validasi password
    if ($password !== $confirmPassword) {
        $error_message = "Password dan konfirmasi password tidak cocok.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid!";
    } else {
        // Cek apakah email atau nomor telepon sudah digunakan
        $checkQuery = "SELECT * FROM user WHERE email = ? OR phone = ?";
        $stmt = mysqli_prepare($connection, $checkQuery);
        mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
        mysqli_stmt_execute($stmt);
        $checkResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($checkResult) > 0) {
            $error_message = "Email atau nomor telepon sudah digunakan!";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data dengan prepared statement
            $sql = "INSERT INTO user (username, password, email, phone, alamat, kota) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $username, $hashedPassword, $email, $phone, $address, $location);

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "Berhasil membuat akun! Silakan login.";
            } else {
                $error_message = "Terjadi kesalahan: " . mysqli_error($connection);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "header/header.php"; ?>
    <style>
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .success-message {
            color: green;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php include "header/nav.php"; ?>

    <div class="heading" style="background:url(https://images.unsplash.com/photo-1665334327488-9f952424db9e?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat">
    <section class="booking d-flex flex-column align-items-center">
        <h1 class="heading-title">Daftar Akun</h1>

        <form method="POST" action="" class="book-form" id="registerForm">
            <?php if (!empty($success_message)) { ?>
                <div class="success-message" style="margin-bottom: 20px;font-size: 20px;"><?php echo $success_message; ?></div>
            <?php } ?>
    
            <?php if (!empty($error_message)) { ?>
                <div class="error-message" style="margin-bottom: 20px;font-size: 20px;"><?php echo $error_message; ?></div>
            <?php } ?>
            <div class="flex">
                <div class="inputBox">
                    <span>Username :</span>
                    <input type="text" placeholder="enter your username" name="username" required>
                </div>
                <div class="inputBox">
                    <span>Password :</span>
                    <input type="password" placeholder="enter password" name="password" required>
                </div>
                <div class="inputBox">
                    <span>Konfirmasi Password :</span>
                    <input type="password" placeholder="confirm password" name="password1" required>
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                    <div id="emailError" class="error-message"></div>
                </div>
                <div class="inputBox">
                    <span>Nomor Telephone :</span>
                    <input type="number" placeholder="enter Phone Number" name="phone" required>
                </div>
                <div class="inputBox">
                    <span>Alamat :</span>
                    <input type="text" placeholder="enter address" name="address" required>
                </div>
                <div class="inputBox">
                    <span>Asal Kota :</span>
                    <input type="text" placeholder="enter City" name="location" required>
                </div>
            </div>
            <br>
            
            <div class="d-flex justify-content-between">
                <input type="submit" value="submit" class="btn" name="send">
                <div class="inputBox fs-2">
                    <a href="login.php" style="margin-bottom: -5px;" class="btn text-decoration-none">Halaman Login</a>
                </div>
            </div>
        </form>
    </section>
    </div>

    <section class="footer">
        <div class="credit"> designed by <span>UTY</span> | Universitas Teknologi Yogyakarta -  <?= date('Y'); ?> </div>
    </section>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script>
        const emailInput = document.getElementById("email");
        const emailError = document.getElementById("emailError");
        const form = document.getElementById("registerForm");

        emailInput.addEventListener("input", () => {
            const emailValue = emailInput.value;
            const domainRegex = /^[^\s@]+@[^\s@]+\.[a-z]{2,4}$/;

            if (!domainRegex.test(emailValue)) {
                emailError.textContent = "Email harus lengkap seperti wonotix@gmail.com";
            } else {
                emailError.textContent = "";
            }
        });

        form.addEventListener("submit", (e) => {
            const emailValue = emailInput.value;

            if (!/^[^\s@]+@[^\s@]+\.[a-z]{2,4}$/.test(emailValue)) {
                e.preventDefault();
                emailError.textContent = "Email harus lengkap seperti wonotix@gmail.com";
            }
        });
    </script>
    <script script src="js/script.js"></script>
</body>
</html>
