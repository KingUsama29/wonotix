<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Ticket</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <style>
      .ticket-container {
        max-width: 700px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
      }
      .ticket-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .ticket-header h2 {
        font-size: 1.75rem;
        font-weight: bold;
      }
      .ticket-section {
        margin-bottom: 20px;
      }
      .ticket-section h5 {
        font-weight: bold;
        margin-bottom: 10px;
      }
      .ticket-footer {
        text-align: center;
        font-size: 0.9rem;
        color: #6c757d;
      }
      .ticket-footer strong {
        color: #343a40;
      }
    </style>
  </head>
  <body style="background-color: #e9ecef">
    <?php
        // Create connection
        $conn = new mysqli('localhost', 'root', '', 'book_db');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
        if (!$order_id) {
            die("Order ID tidak ditemukan.");
        }

        // SQL query with prepared statement
        $sql = $conn->prepare("SELECT * FROM payments WHERE order_id = ?");
        $sql->bind_param("s", $order_id); // 's' untuk string
        $sql->execute();
        $result = $sql->get_result();
    ?>
    <!-- <div class="text-center mt-3">
        <a href="generate_pdf.php?order_id=<?= urlencode($order_id) ?>" class="btn btn-primary">
            Download PDF
        </a>
    </div> -->
    <div class="ticket-container">
        
        <div class="ticket-header">
            <h2>E-Ticket WonoTix</h2>
            <p class="text-muted">Terima kasih telah melakukan pembayaran.</p>
        </div>

        <div class="ticket-section">
            <h5>Detail Pemesanan</h5>
            <table class="table table-bordered">
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <th>Order ID</th>
                        <td><?= htmlspecialchars($row['order_id']) ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pemesan</th>
                        <td><?= htmlspecialchars($row['nama_pemesan']) ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td><?= htmlspecialchars($row['telepon']) ?></td>
                    </tr>
                    <tr>
                        <th>Destinasi</th>
                        <td><?= htmlspecialchars($row['destinasi']) ?></td>
                    </tr>
                    <tr>
                        <th>Tamu</th>
                        <td><?= htmlspecialchars($row['tamu']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kunjungan</th>
                        <td><?= htmlspecialchars($row['tanggal_kunjungan']) ?></td>
                    </tr>
                <?php 
                    } 
                } else { ?>
                    <tr><td colspan="2">Data tidak ditemukan.</td></tr>
                <?php } ?>
            </tbody>
            <i>*Tunjukkan E-Tiket Ini Ke Setiap Destinasi Yang Telah Anda Pesan</i>
            </table>
        </div>

        <div class="ticket-footer">
            <p>Harap tunjukkan tiket ini saat kunjungan ke Loket Masing-Masing Destinasi</p>
            <p>
            Jika ada kendala, hubungi kami di
            <a href="tel:+628112865588"> <i class="fas fa-phone"></i> +62 811-2865-588 </a> atau email
            <a href="mailto:wonotix@gmail.com"> <i class="fas fa-envelope"></i>wonotixofficial@gmail.com</a>.
            </p>
        </div>
        <div class="text-center mt-3">
          <div class="row">
            <div class="col-12">
              <button onclick="window.history.back()" class="btn btn-primary btn-block">
                Kembali
              </button>
            </div>
          </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
