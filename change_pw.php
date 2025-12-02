<?php
session_start();

// Koneksi ke database
$connection = mysqli_connect('localhost', 'root', '', 'book_db');

if (isset($_POST['reset_password'])) {
    // Mengambil data dari form
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    // Validasi input
    if ($new_password !== $confirm_password) {
        $error = "Password baru dan konfirmasi password tidak sama.";
    } else {
        // Hash password baru
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Query untuk mencari user berdasarkan nomor telepon dan email
        $sql = "SELECT * FROM user WHERE phone = '$phone' AND email = '$email'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Jika user ditemukan, update password
            $update_sql = "UPDATE user SET password = '$hashed_password' WHERE phone = '$phone' AND email = '$email'";
            if (mysqli_query($connection, $update_sql)) {
                $success_message = "Password berhasil direset. Silakan login kembali.";
            } else {
                $error = "Terjadi kesalahan saat mereset password.";
            }
        } else {
            $error = "Nomor telepon atau email tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php
      include "header/header.php";
   ?> 
</head>
<body>
   
<!-- header section starts  -->


<!-- header section ends -->


<!-- forgot password section starts  -->

<div class="heading" style="background:url(https://images.unsplash.com/photo-1665334327488-9f952424db9e?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D/bg-login.jpg) no-repeat">
<section class="booking d-flex flex-column align-items-center">

   <h1 class="heading-title">Lupa Password</h1>

   <?php if (isset($success_message)) { ?>
      <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $success_message; ?></div>
   <?php } ?>

   <?php if (isset($error)) { ?>
      <div class="alert alert-danger text-center mt-5 fs-3">
          <?= htmlspecialchars($error) ?>
      </div>
   <?php } ?>

   <form action="" method="post" class="book-form rounded col-md-8">
        <div class="flex">
            <div class="inputBox">
                <span>Nomor Telepon :</span>
                <input type="text" placeholder="Masukkan nomor telepon Anda" name="phone" required>
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" placeholder="Masukkan email Anda" name="email" required>
            </div>
            <div class="inputBox">
                <span>Password Baru :</span>
                <input type="password" placeholder="Masukkan password baru" name="new_password" required>
            </div>
            <div class="inputBox">
                <span>Konfirmasi Password Baru :</span>
                <input type="password" placeholder="Konfirmasi password baru" name="confirm_password" required>
            </div>
        </div>
        <br>
      <input type="submit" value="Reset Password" class="btn" name="reset_password">
      <a href="login.php" class="btn float-end">Kembali</a>
   </form>
</section>
</div>
<!-- forgot password section ends -->
<!-- footer section starts  -->
<section class="footer">
     <div class="credit"> designed by <span>UTY</span> | Universitas Teknologi Yogyakarta -  <?= date('Y'); ?> </div>
</section>
    <!-- footer section ends -->
<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
