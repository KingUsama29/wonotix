<?php
require_once dirname(__FILE__) . '/midtrans/Midtrans.php';
header("Content-Type: application/json");

// Konfigurasi Midtrans
\Midtrans\Config::$serverKey = 'Isi punya lu';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Ambil input notifikasi dari Midtrans
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Logging (optional untuk debugging)
file_put_contents(__DIR__ . '/log_notifikasi.txt', date('Y-m-d H:i:s') . "\n" . $input . "\n\n", FILE_APPEND);

// Validasi input
if (!$data || !isset($data['transaction_status']) || !isset($data['order_id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON or missing fields"]);
    exit();
}

$transaction_status = $data['transaction_status'];
$order_id = $data['order_id'];

// Mapping status Midtrans ke database
$status_map = [
    'settlement' => 'success',
    'capture'    => 'success',
    'pending'    => 'pending',
    'expire'     => 'failed',
    'cancel'     => 'failed',
    'deny'       => 'failed'
];
$new_status = $status_map[$transaction_status] ?? 'pending';

// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'book_db');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Update status pembayaran
$stmt = $conn->prepare("UPDATE payments SET status = ? WHERE order_id = ?");
$stmt->bind_param('ss', $new_status, $order_id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Status updated to '$new_status' for Order ID: $order_id"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to update status"]);
}

$stmt->close();
$conn->close();
http_response_code(200);
