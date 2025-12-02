<footer class="main-footer">
    <strong>Copyright &copy; <?=date('Y')?> <a href="https://uty.ac.id/">Universitas Teknologi Yogyakarta</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/travel/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/travel/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/travel/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/travel/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/travel/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/travel/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/travel/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/travel/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/travel/admin/plugins/moment/moment.min.js"></script>
<script src="/travel/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/travel/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/travel/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/travel/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/travel/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/travel/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/travel/admin/dist/js/pages/dashboard.js"></script>
<!-- DataTabl/travel/admin/Plugins -->
<script src="/travel/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/travel/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/travel/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/travel/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/travel/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/travel/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/travel/admin/plugins/jszip/jszip.min.js"></script>
<script src="/travel/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/travel/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/travel/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/travel/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/travel/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil URL halaman saat ini
        var currentUrl = window.location.href;

        // Seleksi semua link di dalam sidebar
        var sidebarLinks = document.querySelectorAll('.nav-link');

        // Loop melalui setiap link
        sidebarLinks.forEach(function (link) {
            // Jika href link cocok dengan URL saat ini
            if (link.href === currentUrl) {
                // Tambahkan class active ke elemen link
                link.classList.add('active');
                // Cari parent ul dan li untuk menambahkan class menu-open (jika ada submenu)
                var parentLi = link.closest('.nav-item');
                if (parentLi) {
                    parentLi.classList.add('menu-open');
                }
                // Tambahkan class active ke link parent
                var parentLink = parentLi?.querySelector('.nav-link');
                if (parentLink && parentLink !== link) {
                    parentLink.classList.add('active');
                }
            }
        });
    });
</script>
