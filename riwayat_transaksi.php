<?php
include 'auto_check_user.php';
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'book_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data pemesan dari session
$namaPemesan = $_SESSION['username'];
$email = $_SESSION['email'];
$telepon = $_SESSION['phone'];

// Query untuk mengambil riwayat pesanan
$sql = $conn->prepare(
    "SELECT * FROM payments WHERE nama_pemesan = ? OR email = ? OR telepon = ? ORDER BY created_at DESC"
);
$sql->bind_param("sss", $namaPemesan, $email, $telepon);
$sql->execute();
$result = $sql->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "header/header.php";
    ?> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .order-card {
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-bottom: 15px;
        }
        .order-header {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .order-details {
            margin-top: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- header section starts  -->
        <?php
            include "header/nav.php";
        ?> 
    <!-- header section ends -->
    <section class="booking">
        <h1 class="heading-title text-center">Riwayat Pesanan Anda</h1>
        <div class="container mt-4">
            <?php if (!empty($orders)) : ?>
                <?php foreach ($orders as $order) : 
                    $order_id = htmlspecialchars($order['order_id']);
                    ?>
                    <div class="order-card">
                        <div class="order-header fs-3">Order ID: <?= htmlspecialchars($order['order_id']) ?></div>
                        <div class="order-details fs-3">
                            <p><strong>Nama:</strong> <?= htmlspecialchars($order['nama_pemesan']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                            <p><strong>Telepon:</strong> <?= htmlspecialchars($order['telepon']) ?></p>
                            <p><strong>Tamu:</strong> <?= htmlspecialchars($order['tamu']) ?></p>
                            <p><strong>Tanggal Kunjungan:</strong> <?= htmlspecialchars($order['tanggal_kunjungan']) ?></p>
                            <p><strong>Total Harga:</strong> Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></p>
                            <!-- <p><strong>Status:</strong> 
                                <span class="badge bg-<?= $order['status'] === 'success' ? 'success' : ($order['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                    <?= htmlspecialchars($order['status']) ?>
                                </span>
                            </p> -->
                            <p><strong>Tanggal Pembayaran:</strong> <?= htmlspecialchars($order['tanggal_pembayaran']) ?></p>
                        </div>
                        <a href="payment/invoice.php?order_id=<?=$order_id?>" class="fs-4 text-decoration-none">E-TICKET</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-muted fs-3">Tidak ada riwayat pesanan ditemukan.</p>
            <?php endif; ?>
        </div>
    </section>

<!-- footer section starts  -->
   <?php
      include "footer/footer.php";
   ?> 
<!-- footer section ends -->
</body>
</html>
