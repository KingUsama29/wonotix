<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_user']) && !isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['phone'])) {
    header("Location: /travel/login.php");
    exit();
}
