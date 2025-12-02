<?php
date_default_timezone_set('Asia/Makassar');
require_once dirname(__FILE__) . '\midtrans\Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-T5qB8YD7xCQVodtqZkWwCtgS';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$order_id = 'ORDER-' . uniqid();
$nama = $_POST['nama'];
$email = $_POST['email'];
$phone = $_POST['telepon'];
$destinasi = $_POST['destinasi'];
$tamu  = $_POST['guests'];
$tanggal_kunjungan = $_POST['arrivals'];
$tgl_kunjungan_url = urlencode($tanggal_kunjungan);
$tanggal_pembayaran = date('Y-m-d H:i:s');

$total_harga = $_POST['total_harga'];
$cleanedPrice = str_replace(['Rp', '.', ' '], '', $total_harga);
$gross_amount = intval($cleanedPrice);

$conn = new mysqli('localhost', 'root', '', 'book_db');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO payments (order_id, nama_pemesan, email, telepon, destinasi, tamu, tanggal_kunjungan, total_harga, tanggal_pembayaran, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param('sssssssds', $order_id, $nama, $email, $phone, $destinasi, $tamu, $tanggal_kunjungan, $gross_amount, $tanggal_pembayaran);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

$params = array(
    'transaction_details' => array(
        'order_id' => $order_id,
        'gross_amount' => $gross_amount,
    ),
    'customer_details' => array(
        'first_name' => $nama,
        'last_name' => '',
        'email' => $email,
        'phone' => $phone,
    ),
    'callbacks' => array(
        'finish' => 'https://eba3-2400-9800-761-a430-9403-200c-718d-ed35.ngrok-free.app/travel/payment/invoice.php',
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
echo $snapToken;
