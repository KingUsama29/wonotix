<button type="button" class="scroll-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>
<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>quick links</h3>
         <a href="index.php"> <i class="fas fa-angle-right"></i>Beranda</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i>Tentang</a>
         <a href="package.php"> <i class="fas fa-angle-right"></i>Galeri</a>
         <a href="book.php"> <i class="fas fa-angle-right"></i>Pesan</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i>Login</a>
      </div>
      <!-- <div class="box">
         <h3>extra links</h3>
         <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
         <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
         <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
         <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
      </div> -->
      <div class="box">
         <h3>contact info</h3>
         <a href="tel:+628112865588"> <i class="fas fa-phone"></i> +62 811-2865-588 </a>
         <a href="mailto:wonotixofficial@gmail.com"> <i class="fas fa-envelope"></i>@wonotixofficial@gmail.com</a>
         <a href="https://www.google.com/maps/place/wonotix+Village/@-7.6878247,110.3710331,17z/data=!3m1!4b1!4m6!3m5!1s0x2e7a5f6a30f765dd:0x42930b153c711354!8m2!3d-7.68783!4d110.373608!16s%2Fg%2F11spg0pfqg?authuser=0&entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D" target="_blank"> <i class="fas fa-map"></i>Jl. Kenangan, Krandon, Pandowoharjo, Kec. Wonosobo, Kabupaten Wonosobo, Wonosobo 55512</a>
      </div>
      <div class="box">
         <h3>follow us</h3>
         
         <a href="#" target="_blank"> <i class="fab fa-youtube"></i> Youtube </a>
         <a href="#" target="_blank"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#" target="_blank"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#" target="_blank"> <i class="fab fa-tiktok"></i> Tiktok </a>
      </div>
   </div>
</section>
<script>
   $(document).ready(function() {
      $('.navbar a').click(function() {
            $('.navbar a').removeClass('active');
            $(this).addClass('active');
      });

      var current = window.location.href;
      $('.navbar a').each(function() {
            if (this.href === current) {
               $(this).addClass('active');
            }
      });
   });
</script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="/travel/js/script.js"></script>