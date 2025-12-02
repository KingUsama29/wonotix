<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username_petugas']) && !isset($_SESSION['id_petugas']) && !isset($_SESSION['level'])) {
    header("Location: /travel/admin/login_petugas.php");
    exit();
}
