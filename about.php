<?php
session_start();

// Proses input ulasan jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'book_db');

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : $conn->real_escape_string($_POST['username']);
    $rating = intval($_POST['rating']);
    $komentar = $conn->real_escape_string($_POST['komentar']);
    $tanggal = date('Y-m-d');

    // Validasi data
    if (empty($username) || empty($rating) || empty($komentar)) {
        $_SESSION['error'] = "Semua kolom harus diisi.";
    } else {
        // Simpan data ke tabel ulasan
        $sql = "INSERT INTO ulasan (username, date, rating, komentar) VALUES ('$username',  '$tanggal', '$rating', '$komentar')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Ulasan berhasil dikirim!";
        } else {
            $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
        }
    }

    // Redirect ke halaman yang sama untuk menghindari resubmit form
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
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

   <?php
      include "header/nav.php";
   ?> 

<!-- header section ends -->

<div class="heading" style="background:url(https://images.unsplash.com/photo-1694098140562-47411d497f8c?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) no-repeat">
   <h1>Tentang Kami</h1>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="image">
      <img src="images/about.jpg" alt="">
   </div>

   <div class="content">
      <h3>Kenapa Harus Wonotix?</h3>
      <p>WONOTIX hadir sebagai solusi mudah dan terpercaya untuk kamu yang ingin menjelajahi berbagai tempat wisata di Wonosobo, terutama kawasan Dieng. Dengan sistem pemesanan online yang praktis, kamu bisa menghindari antrean, menghemat waktu, dan langsung mendapatkan tiket dari genggaman tanganmu.</p>
      <p>
         Kami bekerja sama langsung dengan pengelola resmi wisata, sehingga semua tiket yang kamu beli dijamin asli dan valid. Cukup pilih destinasi favorit, bayar dengan aman, dan nikmati perjalanan tanpa ribet. WONOTIX cocok untuk wisatawan lokal maupun luar daerah yang ingin liburan lebih nyaman dan efisien.
         Jadikan setiap liburan ke Wonosobo lebih terencana, lebih cepat, dan tanpa hambatan—bersama WONOTIX. 🌿
      </p>
      <div class="icons-container">
         <div class="icons">
            <i class="fas fa-map"></i>
            <span>top destinations</span>
         </div>
         <div class="icons">
            <i class="fas fa-headset"></i>
            <span>24/7 guide service</span>
         </div>
         <div class="icons">
            <i class="fas fa-hand-holding-usd"></i>
            <span>reasonable price</span>
         </div>
      </div>
   </div>

</section>

<!-- about section ends -->

<!-- reviews section starts  -->

<section class="reviews">
    <h1 class="heading-title"> Ulasan Pengunjung </h1>
    
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
         <div class="carousel-inner">
            <?php
            // Koneksi ke database
            $conn = new mysqli('localhost', 'root', '', 'book_db');
            
            // Cek koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }
            
            // Ambil data ulasan
            $sql = "SELECT username,date, rating, komentar FROM ulasan ORDER BY id_ulasan DESC";
            $result = $conn->query($sql);
            
            $active = true; // Untuk menandai slide pertama sebagai aktif
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stars = str_repeat('<i class="fas fa-star"></i>', $row['rating']); // Generate bintang
                    echo '<div class="carousel-item ' . ($active ? 'active' : '') . '">';
                    echo '  <div class="stars">' . $stars . '</div>';
                    echo '  <p class="text-center">' . htmlspecialchars($row['komentar']) . '</p>';
                    echo '  <h3>' . htmlspecialchars($row['username']) . '</h3>';
                    echo '  <span>pengunjung</span>';
                    echo '  <div class="text-dark fs-4">' . $row['date'] . '</div>';
                    echo '</div>';
                    $active = false; // Setelah slide pertama, semua berikutnya tidak aktif
                }
            } else {
                echo '<div class="carousel-item active">';
                echo '<p>Belum ada ulasan dari pengunjung.</p>';
                echo '</div>';
            }

            $conn->close(); // Tutup koneksi
            ?>
        </div>
        <!-- Navigation Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon text-dark fs-1" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
      </div>

      
      <!--Form Input Ulasan -->
      <div class="container mt-5 fs-4">
         <h1 class="text-center mb-4">Form Ulasan Pengunjung</h1>
         <form method="POST" action="">
            <div class="mb-3">
                  <label for="username" class="form-label">Nama Pengguna</label>
                  <?php
                     if(isset($_SESSION['username'])){
                  ?>
                  <input type="text" class="form-control py-4 fs-4" id="username" name="username" placeholder="Masukkan nama Anda" value="<?php echo $_SESSION['username']?>" required disabled> 
                  <?php
                  }else{
                  ?>
                  <input type="text" class="form-control py-4 fs-4" id="username" name="username" placeholder="Masukkan nama Anda" required>
                  <?php
                  }
                  ?>
            </div>
            <div class="mb-3">
                  <label for="rating" class="form-label">Rating</label>
                  <select class="form-select py-4 fs-4" id="rating" name="rating" required>
                     <option value="" disabled selected>Pilih rating</option>
                     <option value="1">1 - Sangat Buruk</option>
                     <option value="2">2 - Buruk</option>
                     <option value="3">3 - Cukup</option>
                     <option value="4">4 - Baik</option>
                     <option value="5">5 - Sangat Baik</option>
                  </select>
            </div>
            <div class="mb-3">
                  <label for="komentar" class="form-label">Komentar</label>
                  <textarea class="form-control fs-4" id="komentar" name="komentar" rows="4" placeholder="Tulis komentar Anda" style="height:40vh;" required></textarea>
            </div>
               <?php if (isset($_SESSION['username'])) { ?>
               <input type="submit" value="submit" class="btn" name="send">
            <?php } else { ?>
               <input type="button" value="Login Dahulu" class="btn" onclick="window.location.href='login.php'">
            <?php } ?>
         </form>
      </div>
</section>



<!-- reviews section ends -->
<!-- footer section starts  -->
   <?php
      include "footer/footer.php"
   ?>
<!-- footer section ends -->
 
<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>