-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 09:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `foto`, `judul`, `caption`) VALUES
(1, 'WhatsApp Image 2024-06-24 at 11.39.47.jpeg', 'Pintu Langit', 'Pintu Langit Wonosobo adalah spot wisata alam yang menawarkan pemandangan indah Gunung Sindoro dan lautan awan dari ketinggian. Cocok untuk menikmati sunrise 🌅, berfoto estetik 📸, dan merasakan udara sejuk pegunungan ❄️. Terletak di Kejajar, Wonosobo, tempat ini jadi favorit traveler untuk healing dan berburu momen Instagramable. 🌤️✨'),
(3, '055fd9f6a2200b8effca7e5b85e376ad.jpg', 'Taman Langit Wonosobo', 'aman Langit Wonosobo adalah destinasi wisata kekinian di ketinggian yang menyajikan taman bunga warna-warni 🌼, spot foto instagramable 📸, dan pemandangan alam memukau ke arah pegunungan Dieng ⛰️. Udara sejuk 🍃 dan suasana tenang menjadikannya tempat ideal untuk healing dan piknik bersama keluarga atau pasangan 💑. Lokasinya mudah dijangkau dari pusat kota Wonosobo.'),
(4, 'fb_img_160898646084469636249903663474853326.jpg', 'Bukit Awan Sikapuk', 'Bukit Awan Sikapuk adalah tempat wisata alam tersembunyi di Wonosobo yang menyuguhkan pemandangan awan bergulung bak negeri di atas langit 🌄. Dari puncaknya, kamu bisa melihat lanskap pegunungan dan sunrise yang magis 🌅. Tempat ini cocok untuk camping 🏕️, foto alam 📸, dan menikmati udara sejuk khas pegunungan 🌬️. Lokasinya masih alami, ideal untuk pencinta petualangan dan ketenangan.'),
(5, 'Telaga_Warna_in_The_Dieng_Plateau.jpg', 'Telaga Warna', ' Telaga Warna Wonosobo adalah danau alami di kawasan Dieng yang terkenal karena airnya yang bisa berubah warna, mulai dari hijau, biru, hingga keemasan ✨. Fenomena ini terjadi karena kandungan mineral dan pantulan cahaya matahari 🌞. Dikelilingi hutan hijau dan kabut tipis 🌿☁️, Telaga Warna cocok untuk bersantai, foto alam 📸, dan menikmati suasana sejuk pegunungan 🍃. Lokasi ini juga sarat cerita legenda lokal yang menambah daya tariknya.'),
(6, '614ea1f2206ed.jpg', 'Candi Arjuna', 'Candi Arjuna adalah kompleks candi Hindu tertua di dataran tinggi Dieng, Wonosobo, yang dibangun pada abad ke-8 Masehi 🕉️. Dikelilingi kabut dan pegunungan Dieng ⛰️, suasananya terasa magis dan tenang 🍃. Candi ini sering dijadikan tempat wisata sejarah dan foto budaya 📸, serta menjadi saksi peninggalan peradaban kuno di Jawa Tengah. Ideal untuk kamu yang suka wisata alam sekaligus sejarah.');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id_payment` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `destinasi` varchar(100) NOT NULL,
  `tamu` varchar(100) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','success','failed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id_payment`, `order_id`, `nama_pemesan`, `email`, `telepon`, `destinasi`, `tamu`, `tanggal_kunjungan`, `total_harga`, `tanggal_pembayaran`, `status`) VALUES
(1, 'ORDER-676952efd6f1e', 'Usama fadlilah ', 'fadliUsama@yahoo.com', '12121212', '', '2 orang dewasa', '2024-12-24', 50000.00, '2024-12-23 13:09:19', 'pending'),
(2, 'ORDER-67699509e4027', 'Satrio', 'satriolp221@gmail.com', '085892320437', '', '1 orang dewasa, 1 anak bayi', '2024-12-23', 40000.00, '2024-12-23 17:09:07', 'failed'),
(3, 'ORDER-676996263914c', 'sauqi', 'asepbakar@gmail.com', '1212112', '', '5 orang dewasa', '2024-12-28', 150000.00, '2024-12-23 17:56:06', 'pending'),
(4, 'ORDER-6769966d574ab', 'sauqi', 'asepbakar@gmail.com', '1212112', '', '4 orang dewasa', '2024-12-28', 120000.00, '2024-12-23 17:57:17', 'pending'),
(5, 'ORDER-6769985e8c63a', 'riski', 'riski@gmail.com', '21212131', '', '2 orang dewasa', '2024-12-28', 60000.00, '2024-12-23 17:05:48', 'success'),
(6, 'ORDER-676998f3001d1', 'affa', 'narji321@gmail.com', '12121212', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-23 17:08:46', 'success'),
(7, 'ORDER-67699b1fbb9eb', 'joko', 'joko123@gmail.com', '1311312', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-23 17:17:33', 'success'),
(8, 'ORDER-676bb45e8ed8a', 'sauqi', 'asepbakar@gmail.com', '12112121', '', '1 orang dewasa', '2024-12-26', 25000.00, '2024-12-25 08:29:34', 'pending'),
(9, 'ORDER-676bb4f3bd672', 'sauqi', 'asepbakar@gmail.com', '121212', '', '2 orang dewasa', '2024-12-25', 50000.00, '2024-12-25 08:32:03', 'pending'),
(10, 'ORDER-676bb59eed2aa', 'sauqi', 'narji321@gmail.com', '12121212', '', '2 orang dewasa', '2024-12-25', 50000.00, '2024-12-25 08:34:54', 'pending'),
(11, 'ORDER-676bb9b7d1f78', 'sauqi', 'narji321@gmail.com', '1211212', '', '1 orang dewasa', '2024-12-26', 25000.00, '2024-12-25 08:52:23', 'pending'),
(12, 'ORDER-676bbadbc7699', 'sauqi', 'narji321@gmail.com', '1211212', '', '1 orang dewasa', '2024-12-26', 25000.00, '2024-12-25 08:57:15', 'pending'),
(13, 'ORDER-676bbb6e0998c', 'sauqi', 'fadliUsama@yahoo.com', '87676775', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 07:59:59', 'success'),
(14, 'ORDER-676bbea49dc26', 'Ahmad ', 'Ahmad@gmail.com', '123131321', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 08:13:38', 'success'),
(17, 'ORDER-676bd9b825ac5', 'usama fadlilah', 'fadliUsama@yahoo.com', '121312312', '', '2 orang dewasa', '2024-12-28', 60000.00, '2024-12-25 10:09:40', 'success'),
(21, 'ORDER-676bfc4635676', 'Allamsyah', 'allam@gmail.com', '2121313', '', '4 orang dewasa', '2024-12-26', 100000.00, '2024-12-25 12:36:44', 'success'),
(22, 'ORDER-676c0df2409b7', 'Usama fadlilah ', 'fadliUsama@yahoo.com', '212121', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 13:51:58', 'success'),
(23, 'ORDER-676c0f5859dcc', 'Usama fadlilah ', 'allam@gmail.com', '212121', '', '1 orang dewasa', '2024-12-26', 25000.00, '2024-12-25 13:57:56', 'success'),
(24, 'ORDER-676c12d3454b2', 'allam', 'allam@gmail.com', '083867872230', '', '1 orang dewasa', '2024-12-26', 25000.00, '2024-12-25 14:28:43', 'failed'),
(25, 'ORDER-676c131294d7e', 'allam', 'allam@gmail.com', '083867872230', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 14:29:43', 'failed'),
(26, 'ORDER-676c14ceb6155', 'allam', 'allam@gmail.com', '21211212', '', '2 orang dewasa, 1 anak bayi', '2024-12-26', 65000.00, '2024-12-25 15:21:02', 'pending'),
(27, 'ORDER-676c16be16a49', 'allam', 'allam@gmail.com', '21211121', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 15:29:18', 'pending'),
(28, 'ORDER-676c280e2beac', 'allam', 'allam@gmail.com', '12121212', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 15:59:12', 'failed'),
(29, 'ORDER-676c29708cb8b', 'allam', 'allam@gmail.com', '212121', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 15:49:25', 'success'),
(30, 'ORDER-676c29ef30db7', 'allam', 'allam@gmail.com', '233333', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 15:51:36', 'success'),
(31, 'ORDER-676c2a809f5f1', 'allam', 'allam@gmail.com', '233333', '', '10 orang dewasa', '2024-12-26', 250000.00, '2024-12-25 15:57:22', 'failed'),
(32, 'ORDER-676c2b83838a3', 'allam', 'allam@gmail.com', '233333', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 15:58:44', 'success'),
(33, 'ORDER-676c2bcb5c01f', 'allam', 'allam@gmail.com', '233333', '', '9 orang dewasa', '2024-12-26', 225000.00, '2024-12-25 15:59:21', 'success'),
(34, 'ORDER-676c2d0c0a32d', 'allam', 'allam@gmail.com', '233333', '', '2 orang dewasa', '2024-12-26', 50000.00, '2024-12-25 16:04:52', 'success'),
(35, 'ORDER-676c2ebab70b9', 'allam', 'allam@gmail.com', '212112121111', '', '4 orang dewasa', '2024-12-26', 100000.00, '2024-12-25 16:11:55', 'success'),
(36, 'ORDER-676c2f7eed753', 'allam', 'allam@gmail.com', '083867872230', '', '2 orang dewasa', '2024-12-27', 50000.00, '2024-12-25 16:15:23', 'success'),
(37, 'ORDER-676c319f73dc2', 'usama fadlillah ', 'fadliUsama@yahoo.com', '083867872230', '', '2 orang dewasa', '2024-12-27', 50000.00, '2024-12-25 16:24:36', 'success'),
(38, 'ORDER-676c39811ef9b', 'udin', 'asdasf@gmail.com', '1213', '', '3 orang dewasa', '2024-12-26', 75000.00, '2024-12-25 17:13:48', 'failed'),
(39, 'ORDER-676c39e9df8c0', 'udin', 'asdasf@gmail.com', '1213', '', '4 orang dewasa', '2024-12-26', 100000.00, '2024-12-25 17:00:13', 'success'),
(40, 'ORDER-676eb1b3a006e', 'sauqi', 'narji321@gmail.com', '083867872230', '', '2 orang dewasa', '2024-12-28', 60000.00, '2024-12-27 13:55:52', 'success'),
(41, 'ORDER-676ebc1cdd389', 'sauqi', 'narji321@gmail.com', '083867872230', '', '2 orang dewasa, 1 anak bayi', '2024-12-27', 65000.00, '2024-12-27 14:40:10', 'success'),
(42, 'ORDER-676eccff0f314', 'usama fadlillah ', 'fadliUsama@yahoo.com', '083867872230', '', '2 orang dewasa, 1 anak bayi', '2024-12-28', 75000.00, '2024-12-27 15:51:39', 'success'),
(43, 'ORDER-683d465929809', 'usama fadlillah ', 'fadliUsama@yahoo.com', '083867872230', '', '2 orang dewasa', '2025-06-03', 50000.00, '2025-06-02 07:36:09', 'pending'),
(44, 'ORDER-684115f90576c', 'sauqi', 'narji321@gmail.com', '083867872230', '', '10 orang dewasa', '2025-06-07', 300000.00, '2025-06-05 04:58:49', 'pending'),
(45, 'ORDER-6841163ff1ef8', 'sauqi', 'narji321@gmail.com', '083867872230', '', '10 orang dewasa', '2025-06-07', 300000.00, '2025-06-05 04:59:59', 'pending'),
(46, 'ORDER-684e6c55763a7', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa, 1 anak bayi', '2025-06-16', 65000.00, '2025-06-15 07:46:45', 'pending'),
(47, 'ORDER-684e7058c0d98', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa', '2025-06-17', 50000.00, '2025-06-15 08:03:52', 'pending'),
(48, 'ORDER-684e70fbc07eb', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa', '2025-06-16', 50000.00, '2025-06-15 08:06:35', 'pending'),
(49, 'ORDER-684e71ae43a7a', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa', '2025-06-16', 50000.00, '2025-06-15 08:09:34', 'pending'),
(50, 'ORDER-684e73aaf1edd', 'imron', 'imron123@gmail.com', '0899887766', '', '1 orang dewasa', '2025-06-17', 25000.00, '2025-06-15 08:18:02', 'pending'),
(51, 'ORDER-684e7b4fb4b68', 'imron', 'imron123@gmail.com', '0899887766', '', '1 orang dewasa', '2025-06-17', 25000.00, '2025-06-15 08:50:39', 'pending'),
(52, 'ORDER-684e7c45473f6', 'imron', 'imron123@gmail.com', '0899887766', '', '4 orang dewasa', '2025-06-18', 100000.00, '2025-06-15 08:54:45', 'pending'),
(53, 'ORDER-684e85b8bc743', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa, 1 anak bayi', '2025-06-20', 65000.00, '2025-06-15 09:35:04', 'pending'),
(54, 'ORDER-684e87f2960f8', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa, 1 anak bayi', '2025-06-24', 65000.00, '2025-06-15 09:44:34', 'pending'),
(55, 'ORDER-684e94aa0c238', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa, 1 anak bayi', '2025-06-24', 65000.00, '2025-06-15 10:38:50', 'pending'),
(56, 'ORDER-684fd99804373', 'imron', 'imron123@gmail.com', '0899887766', '', '2 orang dewasa', '2025-06-21', 60000.00, '2025-06-16 09:45:12', 'pending'),
(57, 'ORDER-6853633ee103b', 'imron', 'imron123@gmail.com', '0899887766', 'Pintu Langit', '2 orang dewasa', '2025-06-20', 50000.00, '2025-06-19 02:09:18', 'pending'),
(58, 'ORDER-68537e4cbf8cf', 'imron', 'imron123@gmail.com', '0899887766', 'Pintu Langit', '2 orang dewasa', '2025-06-21', 60000.00, '2025-06-19 04:04:44', 'pending'),
(59, 'ORDER-68538a1cb6929', 'BasirSwag', 'fubamstream@gmail.com', '083141592653', 'Bukit Awan Sikapuk', '4 orang dewasa, 2 anak bayi', '2025-06-20', 130000.00, '2025-06-19 04:55:08', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `email`, `phone`, `level`, `alamat`, `status`) VALUES
(2, 'narji', '$2y$10$geajI8EpvjyAYWziFpgkn.uIpdr8WB9Zb/VEsYl/fd01jSEQpm.3.', 'narji321@gmail.com', '08386787223', 'Administrator', 'amba1', 'active'),
(16, 'Muhammad sauqi', '$2y$10$mA.O8Z4JEW64u7FIoCe8deo9iaGNMiDhFs1FEjvX0IepSbjNLdpnC', 'sauqi@gmail.com', '083867872222', 'Administrator', 'Trini', 'active'),
(17, 'petugas', '$2y$10$KS3lpe1fPRZvtHytzCwczeWGjs1Kzv6OsUY/gORtryCdyUREMHJSS', 'petugas@gmail.com', '121212121', 'petugas', 'Trini', 'active'),
(18, 'imron', '$2y$10$cJ3T0nYX9uyKfBNZwCHgEO6tFXEKxr/vS3QsvYOVcankV6HQr9NWG', 'imron123@gmail.com', '0811223344', 'petugas', 'Trini', 'active'),
(19, 'faza', '$2y$10$MXictGUHjbSyJQaaE.1wgez9QtA92x/7o0oD8E/kbdboX.ELMGT9u', 'faza@gmail.com', '083867872231', 'petugas', 'Jambon', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `komentar` text NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `username`, `date`, `komentar`, `rating`) VALUES
(1, 'Abdul Manaf', '2024-12-16', 'Tempatnya bagus, bersih, dan banyak tempat untuk spot foto. senang bisa bawa anak-anak main kesini', 5),
(2, 'Purwanto', '2024-12-16', 'Tolong suruh pelayannya untuk lebih ramah lagi, pelayan cowok yang pake kacamat kotak songong banget sama pengunjung yang datang', 3),
(5, 'sauqi', '2024-12-16', 'Tempatnya Keren', 5),
(6, 'allam', '2024-12-17', 'anak istri saya senang kesini', 5),
(7, 'Satrio', '2024-12-23', 'Lit, Sugoi, Daebak, Génial, Guay, Krass, Figo, Massa, Awesome, Круто (Kruto), 酷 (Kù), رهيب (Raheeb), Chido, Wéi, Brilhante, Savage, Epic, Top, Bomb, Fenomenal, Sick, Badass, Tros, Fantástico, Super, Dope, Fire, Wahnsinn, Bravo, Legen, Mint, Class, Banging, Fleek, Joss, Mantap.\r\n\r\n', 5),
(8, 'usama fadlillah ', '2024-12-25', 'Saya suka banget kalo ke jogja pergi kesini', 5),
(9, 'udin', '2024-12-25', 'lumayan menarik untuk wisata keluarga!', 4),
(10, 'sauqi', '2024-12-27', 'Tesss', 1),
(11, 'sauqi', '2025-06-05', 'Bolehlahh', 3),
(12, 'imron', '2025-06-15', 'tempatnya keren', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `phone`, `alamat`, `kota`, `status`) VALUES
(1, 'usama fadlillah ', '$2y$10$aCRhuAu/v7qVPojSzmC/pemgWmc6k29xNLCfuZpTvbaDdiwYJDwW2', 'fadliUsama@yahoo.com', '083867872230', 'Trini', 'Kabupaten Sleman', 'active'),
(2, 'sauqi', '$2y$10$.pILt63f3r0QQkfbQPV2OeaKob/mIfjtb54M3dr9/3KtPSTPY5CkC', 'narji321@gmail.com', '083867872230', 'Trini', 'Kabupaten Sleman', 'active'),
(3, 'allam', '$2y$10$B43OeSIcX67eLBrB0l6/JuONPUzsjjw3AcW.xXsAzdWdJEETSAjh.', 'allam@gmail.com', '083867872230', 'Trini', 'Kabupaten Sleman', 'active'),
(4, 'Satrio', '$2y$10$E/pSwBNbkjKLiH1Gj2qTrOwwPayOLWF8.7FVT0wLsVzbT.XpXTNOu', 'satriolp221@gmail.com', '085892320437', 'Jl pungut', 'Bekasi', 'active'),
(5, 'udin', '$2y$10$68lgXtCzpTFXmAMNkH0/vOxtrfxI4Tg/LQ6ukjC..9ctfqyXipBvS', 'asdasf@gmail.com', '1213', 'trini', 'sleman', 'active'),
(7, 'agung', '$2y$10$CFCeY1Zp7BPsxbctFqD0tuutYp0FHISLAz47WFEdHyqtB.DLmzf0C', 'agung@gmail.com', '083867872230', 'Trini', 'Kabupaten Sleman', 'active'),
(10, 'oneil', '$2y$10$IOaZWoys4vITCW4YdRTBZ.G3ttZGLG2krOEQJItRyh3m0GNhZlJiG', 'oneil@gmail.com', '122121212121', 'Trini', 'Kabupaten Sleman', 'active'),
(11, 'imron', '$2y$10$JVaNzQ4jgcZqKdCFecL0jujeVgPZM5I64EMDgzmTfRHH4hrh469.S', 'imron123@gmail.com', '0899887766', 'jl. pati', 'Pati', 'active'),
(12, 'faza', '$2y$10$EwrFNvcOjeS8CpeH/Lgq6ud918.FFJoAPQK4Sa6vsEtwU7hKbU0wK', 'faza@gmail.com', '081122334455', 'Trini', 'Kabupaten Sleman', 'active'),
(13, 'BasirSwag', '$2y$10$J75AVu4stFxL9JJZTP3JD.XSCIV1ITaq5Nb0/Us2BaoVqNq6njJDG', 'fubamstream@gmail.com', '083141592653', 'Ngampilan', 'Yogyakarta ', 'active'),
(14, 'HambaAllah', '$2y$10$UWTuH2LR7aslDCLm3s5Qqe9.QAAdXbvELwrRbiEQHskUbPTzPXF72', 'HambaAllah19@gamil.com', '085357178348', 'Papua pegunungan', 'Papua', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
