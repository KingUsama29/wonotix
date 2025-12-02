-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 05:52 PM
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
  `status` enum('pending','success','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id_payment`, `order_id`, `nama_pemesan`, `email`, `telepon`, `destinasi`, `tamu`, `tanggal_kunjungan`, `total_harga`, `tanggal_pembayaran`, `status`, `created_at`) VALUES
(62, 'ORDER-685d69ec974f3', 'usama', 'fadliUsama@yahoo.com', '083867872230', 'Candi Arjuna', '3 orang dewasa', '2025-06-28', 90000.00, '2025-06-26 16:40:28', 'pending', '2025-06-26 15:40:28');

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
(2, 'Usama', '$2y$10$HTMlAWUWWfzD8GVnLSDwQ.0ZSYFf8ZjEKXuw6uF7ReJFQ8p1AL/H2', 'usama123@gmail.com', '11223344', 'administrator', 'Jambon', 'active');

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
(1, 'usama', '$2y$10$1GXTm6o7vtdrpKtuOmpex.B4tJC0it7277OOuN0dMQbe98x71BkSW', 'fadliUsama@yahoo.com', '083867872230', 'Trini', 'Kabupaten Sleman', 'active'),
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
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
