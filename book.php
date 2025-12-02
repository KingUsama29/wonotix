<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php
      include "header/header.php";
   ?> 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-_krAZ2YHIjMKnjkW"></script>
   <style>
      .counter-group {
         display: flex;
         align-items: center;
         gap: 10px;
      }
      .counter-btn {
         width: 40px;
         height: 40px;
         text-align: center;
         font-size: 18px;
         font-weight: bold;
         border: 1px solid #ddd;
         background-color: #f8f9fa;
         cursor: pointer;
         border-radius: 5px;
      }
      .counter-btn:disabled {
         cursor: not-allowed;
         opacity: 0.5;
      }
      .counter-value {
         width: 50px;
         text-align: center;
         font-size: 18px;
         font-weight: bold;
         border: none;
         background: none;
      }
   </style>
</head>
<body>
   
<!-- header section starts  -->

   <?php
      include "header/nav.php";
   ?> 

<!-- header section ends -->

<div class="heading" style="background:url(images/danau.png) no-repeat">
   <h1>pesan sekarang</h1>
</div>

<!-- booking section starts  -->

<section class="booking">

   <h1 class="heading-title">booking untuk trip anda!</h1>

   <?php if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) { ?>
      <div class="success-message" style="margin-bottom: 20px;font-size: 20px;color: green;"><?php echo $_SESSION['success_message']; ?></div>
      <?php
      unset($_SESSION['success_message']);
   }
   ?>

   <?php
   // Peringatan jika pengguna belum login
   if (!isset($_SESSION['username'])) {
      echo '<div class="error-message fs-4" style="color: red; margin-bottom: 20px;">Anda harus login terlebih dahulu untuk melakukan pemesanan!</div>';
   }
   ?>

   <form action="" method="POST" class="book-form">

      <div class="flex">
         <div class="inputBox">
            <span>Nama Pemesan :</span>
            <input type="text" id="nama" placeholder="masukan nama anda" name="nama" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" readonly required>
         </div>
         <div class="inputBox">
            <span>Email Aktif :</span>
            <input type="email" id="email" placeholder="masukan email anda" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" readonly required>
         </div>
         <div class="inputBox">
            <span>Telepon (WA Aktif) :</span>
            <input type="number" id="telepon" placeholder="masukan no telpon" name="telepon" value="<?= isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>" readonly required>
         </div>
         <div class="inputBox">
            <span>Pilih Destinasi :</span>
            <select id="destinasi" name="destinasi" class="form-select" required>
               <option value="">-- Pilih Destinasi --</option>
               <option value="Pintu Langit">Pintu Langit</option>
               <option value="Taman Langit">Taman Langit</option>
               <option value="Bukit Awan Sikapuk">Bukit Awan Sikapuk</option>
               <option value="Telaga Warna">Telaga Warna</option>
               <option value="Candi Arjuna">Candi Arjuna</option>
            </select>
         </div>

         <div class="inputBox">
            <span>Tamu :</span>
            <input type="text" id="guestInput" placeholder="Jumlah tamu" name="guests" readonly data-bs-toggle="modal" data-bs-target="#guestModal">
         </div>
         <div class="inputBox">
            <span>Tanggal Berkunjung :</span>
            <input type="date" id="visitDate" name="arrivals" required>
         </div>
         <div class="inputBox">
            <span>Total Harga :</span>
            <input type="text" id="totalPrice" name="total_harga" readonly>
         </div>
      </div>

      <p class="text-danger mt-5 fs-5">*Harga Tiket Weekend Dengan Weekdays Berbeda Untuk Orang Dewasa</p>
      <p class="text-danger fs-5">*Harga Tiket Anak Dibawah 3 Tahun Adalah 15 Ribu</p>

      <?php if (isset($_SESSION['username'])) { ?>
          <input type="submit" value="Lakukan Pembayaran"  id="pay-button" class="btn p-3 text-light fs-4" name="send"  style='background-color:#21c059;'>
      <?php } else { ?>
          <input type="button" value="Login to Book" class="btn p-3 text-light fs-4" onclick="window.location.href='login.php'" style='background-color:#21c059;'>
      <?php } ?>

   </form>
   <?php if (isset($_SESSION['username'])) { ?>
      <div class="border border-primary py-2 px-4 mt-5" style="width:190px; border-radius:100px" >
         <a href="riwayat_transaksi.php" class="fs-4 text-decoration-none text-center">Riwayat Transaksi >></a>
      </div>
   <?php } ?>
</section>
<!-- booking section ends -->


<!-- Modal for Guest Input -->
<div class="modal fade" id="guestModal" tabindex="-1" aria-labelledby="guestModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="guestModalLabel">Detail Tamu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form id="guestDetailsForm">
               <div class="mb-3">
                  <label for="adultGuests" class="form-label">Orang Dewasa:</label>
                  <div class="counter-group">
                     <button type="button" class="counter-btn" id="adultMinus">-</button>
                     <input type="text" class="counter-value" id="adultGuests" value="0" readonly>
                     <button type="button" class="counter-btn" id="adultPlus">+</button>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="childGuests" class="form-label">Anak-anak (di bawah 3 tahun):</label>
                  <div class="counter-group">
                     <button type="button" class="counter-btn" id="childMinus">-</button>
                     <input type="text" class="counter-value" id="childGuests" value="0" readonly>
                     <button type="button" class="counter-btn" id="childPlus">+</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary" id="saveGuestDetails">Simpan</button>
         </div>
      </div>
   </div>
</div>

<!-- footer section starts  -->
   <?php
      include "footer/footer.php";
   ?> 

<!-- footer section ends -->
<script>
   document.addEventListener('DOMContentLoaded', function () {
      const guestInput = document.getElementById('guestInput');
      const visitDate = document.getElementById('visitDate');
      const totalPrice = document.getElementById('totalPrice');
      const adultGuests = document.getElementById('adultGuests');
      const childGuests = document.getElementById('childGuests');
      const payButton = document.getElementById('pay-button');

      function formatCurrency(amount, separator = ',') {
         return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, separator);
      }

      function updateGuestDescription() {
         const adultCount = parseInt(adultGuests.value);
         const childCount = parseInt(childGuests.value);

         let description = '';
         if (adultCount > 0) description += `${adultCount} orang dewasa`;
         if (childCount > 0) {
            if (description) description += ', ';
            description += `${childCount} anak bayi`;
         }
         guestInput.value = description || 'Jumlah tamu';
         calculateTotalPrice();
      }

      function calculateTotalPrice() {
         const adultCount = parseInt(adultGuests.value);
         const childCount = parseInt(childGuests.value);
         const selectedDate = new Date(visitDate.value);
         const day = selectedDate.getDay();

         const isWeekend = (day === 0 || day === 6);
         const adultPrice = isWeekend ? 30000 : 25000;
         const childPrice = 15000;

         const total = (adultCount * adultPrice) + (childCount * childPrice);
         totalPrice.value = total ? formatCurrency(total, '.') : 'Rp 0';
         checkPayButtonState();
      }

      function checkPayButtonState() {
         if (guestInput.value && visitDate.value && totalPrice.value !== 'Rp 0') {
            payButton.disabled = false;
         } else {
            payButton.disabled = true;
         }
      }

      document.getElementById('adultMinus').addEventListener('click', () => {
         adultGuests.value = Math.max(0, parseInt(adultGuests.value) - 1);
         updateGuestDescription();
      });

      document.getElementById('adultPlus').addEventListener('click', () => {
         adultGuests.value = parseInt(adultGuests.value) + 1;
         updateGuestDescription();
      });

      document.getElementById('childMinus').addEventListener('click', () => {
         childGuests.value = Math.max(0, parseInt(childGuests.value) - 1);
         updateGuestDescription();
      });

      document.getElementById('childPlus').addEventListener('click', () => {
         childGuests.value = parseInt(childGuests.value) + 1;
         updateGuestDescription();
      });

      visitDate.addEventListener('change', calculateTotalPrice);

      document.getElementById('saveGuestDetails').addEventListener('click', function () {
         updateGuestDescription();
         const guestModal = bootstrap.Modal.getInstance(document.getElementById('guestModal'));
         guestModal.hide();
      });

      payButton.addEventListener('click', async function (e) {
         e.preventDefault();
         const response = await fetch('payment/placeOrder.php', {
            method: 'POST',
            body: new URLSearchParams(new FormData(document.querySelector('.book-form'))),
         });
         const token = await response.text();
         window.snap.pay(token);
      });

      // Initialize state on page load
      checkPayButtonState();
   });
</script>
</body>
</html>
