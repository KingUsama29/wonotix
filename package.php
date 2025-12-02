<?php 
session_start(); 
$conn = new mysqli('localhost', 'root', '', 'book_db');

// Periksa koneksi
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
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

<div class="heading" style="background:url(images/kebun_teh.png) no-repeat">
   <h1>Galeri</h1>
</div>

<!-- packages section starts  -->
<section class="packages">
   <h1 class="heading-title">Sekilas tentang destinasi WonoTix</h1>

   <div class="box-container">

      <?php
      // Ambil data galeri dari database
      $sql = "SELECT * FROM galeri";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
      ?>
      <div class="box">
         <div class="image">
            <!-- Menampilkan gambar dari database -->
            <img src="admin/dist/galeri/<?= htmlspecialchars($row['foto']); ?>" alt="<?= htmlspecialchars($row['judul']); ?>">
         </div>
         <div class="content">
            <!-- Menampilkan judul dan caption -->
            <h3><?= htmlspecialchars($row['judul']); ?></h3>
            <p><?= nl2br(htmlspecialchars($row['caption'])); ?></p>
         </div>
      </div>
      <?php
          }
      } else {
          echo "<p>Tidak ada data galeri tersedia.</p>";
      }
      ?>

   </div>

   <?php
   if(mysqli_num_rows($result)>6){
      echo "<div class='load-more'><span class='btn'>Lebih banyak</span></div>";
   }
   ?>

</section>
<!-- packages section ends -->

<!-- footer section starts  -->
   <?php
      include "footer/footer.php";
   ?> 
<!-- footer section ends -->

</body>
</html>