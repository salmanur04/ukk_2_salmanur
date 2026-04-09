-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 06:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parkiran`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_parkir`
--

CREATE TABLE `area_parkir` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(50) NOT NULL,
  `kapasitas` int(5) NOT NULL,
  `terisi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_parkir`
--

INSERT INTO `area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(2345, 'Area C', 40, 20),
(12133, 'area B', 30, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tarif_parkir`
--

CREATE TABLE `tarif_parkir` (
  `id_tarif` int(11) NOT NULL,
  `jenis_kendaraan` enum('mobil','motor') NOT NULL,
  `tarif_per_jam` decimal(10,0) NOT NULL,
  `ketentuan_waktu` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif_parkir`
--

INSERT INTO `tarif_parkir` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`, `ketentuan_waktu`) VALUES
(3, 'mobil', 5000, 2),
(4, 'mobil', 5000, 5),
(5, 'motor', 3000, 3),
(7, 'motor', 3000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `plat_nomor` varchar(15) NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `warna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`) VALUES
(1234, 'C 5667 KKM', 'mobil', 'merah'),
(4567, 'D 4567 Hh4ts', 'Motor', 'abu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `user` varchar(11) NOT NULL,
  `role` enum('admin','petugas','owner') NOT NULL,
  `aktivitas` varchar(100) NOT NULL,
  `waktu_aktivitas` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `user`, `role`, `aktivitas`, `waktu_aktivitas`) VALUES
(12, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-03-10 18:52:30'),
(13, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-03-10 18:53:10'),
(14, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-03-10 18:53:35'),
(15, NULL, 'salma', 'petugas', 'Login ke Sistem', '2026-03-10 18:53:49'),
(16, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-03-10 18:56:12'),
(17, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-03-10 18:57:22'),
(18, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-03-10 19:03:26'),
(19, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-03-10 19:12:22'),
(20, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-03-10 19:16:01'),
(21, NULL, 'sansan', 'petugas', 'Login ke Sistem', '2026-03-10 19:16:19'),
(22, NULL, 'sansan', 'petugas', 'Logout dari Sistem', '2026-03-10 19:29:39'),
(23, NULL, 'tiaraa', 'owner', 'Login ke Sistem', '2026-03-10 19:29:58'),
(24, NULL, 'tiaraa', 'owner', 'Logout dari Sistem', '2026-03-10 19:30:26'),
(25, NULL, 'ama', 'admin', 'Login ke Sistem', '2026-03-10 19:30:36'),
(26, NULL, 'ama', 'admin', 'Logout dari Sistem', '2026-03-10 19:36:21'),
(27, NULL, 'sapi', 'petugas', 'Login ke Sistem', '2026-03-10 19:36:31'),
(28, NULL, 'sapi', 'petugas', 'Logout dari Sistem', '2026-03-10 19:45:28'),
(29, NULL, 'salma', 'petugas', 'Login ke Sistem', '2026-03-11 01:17:47'),
(30, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-03-11 01:20:24'),
(31, NULL, 'buaya', 'owner', 'Login ke Sistem', '2026-03-11 01:20:39'),
(32, NULL, 'buaya', 'owner', 'Logout dari Sistem', '2026-03-11 01:20:48'),
(33, NULL, 'ama', 'petugas', 'Login ke Sistem', '2026-03-11 01:21:01'),
(34, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-04-01 07:41:21'),
(35, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-01 08:00:18'),
(36, NULL, 'salma', 'petugas', 'Login ke Sistem', '2026-04-01 08:00:34'),
(37, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-04-01 09:19:42'),
(38, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-01 09:20:29'),
(39, NULL, 'salma', 'petugas', 'Login ke Sistem', '2026-04-07 03:29:36'),
(40, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-07 03:30:10'),
(41, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-04-07 03:30:20'),
(42, NULL, 'admin', 'admin', 'Login ke Sistem', '2026-04-09 02:09:49'),
(43, NULL, 'admin', 'admin', 'Logout dari Sistem', '2026-04-09 02:11:20'),
(44, NULL, 'salma', 'owner', 'Login ke Sistem', '2026-04-09 02:11:39'),
(45, NULL, 'salma', 'owner', 'Logout dari Sistem', '2026-04-09 02:12:04'),
(46, NULL, 'salma', 'petugas', 'Login ke Sistem', '2026-04-09 02:12:24'),
(47, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-09 02:19:48'),
(48, NULL, 'salma', 'admin', 'Login ke Sistem', '2026-04-09 02:19:57'),
(49, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 02:30:31'),
(50, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 02:59:24'),
(51, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 03:01:40'),
(52, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 03:03:01'),
(53, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 03:05:04'),
(54, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-09 03:05:25'),
(55, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 03:21:51'),
(56, NULL, 'salma', 'owner', 'Logout dari Sistem', '2026-04-09 03:26:26'),
(57, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 03:46:22'),
(58, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-09 03:47:23'),
(59, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 03:49:03'),
(60, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-09 03:49:56'),
(61, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 04:10:53'),
(62, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-09 04:40:14'),
(63, NULL, 'salma', 'petugas', 'Logout dari Sistem', '2026-04-09 06:03:23'),
(64, NULL, 'salma', 'admin', 'Logout dari Sistem', '2026-04-09 06:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int(11) NOT NULL,
  `plat_nomor` int(50) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil') NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime NOT NULL,
  `id_tarif` int(11) NOT NULL,
  `durasi_jam` int(5) NOT NULL,
  `biaya_total` decimal(10,0) NOT NULL,
  `status` enum('masuk','keluar') NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `plat_nomor`, `id_kendaraan`, `jenis_kendaraan`, `waktu_masuk`, `waktu_keluar`, `id_tarif`, `durasi_jam`, `biaya_total`, `status`, `id_user`, `id_area`) VALUES
(28, 0, 0, 'mobil', '2026-03-11 13:30:00', '2026-03-11 14:30:00', 0, 1, 5000, 'masuk', 0, 0),
(29, 0, 0, 'mobil', '2026-03-11 09:00:00', '2026-03-11 11:30:00', 0, 3, 15000, 'masuk', 0, 0),
(31, 0, 0, 'mobil', '2026-04-08 09:00:00', '2026-04-08 11:00:00', 0, 2, 10000, 'keluar', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` enum('admin','petugas','owner') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `password`, `username`, `role`) VALUES
(1678, 'salsa', '$2y$10$xO7fnYd1p.q9I1IPsbP3neBnEpkCNOSyK/UnQFlVigF4kbUlw4xNq', 'hicacayp', 'petugas'),
(26050, 'tristaaa', '$2y$10$x8S6jfqC8YExzrhMArt49u4K6XPxUm6hn6jAsd951L1pDQdko1wzO', 'tata', 'petugas'),
(26056, 'deby', '$2y$10$VNz.ZzNMFNcJG8uqF006l.TVXKRBSoZgmeV9ZHFhUsgECrZtNadIe', 'debdeb', 'owner'),
(26059, 'salma', '$2y$10$d6XEx2vbZdsysL1CiVA3UO/tFM6QxqlsgT4xOwb.VtR.LgMrPhbl6', 'amaluiu', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_parkir`
--
ALTER TABLE `area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `tarif_parkir`
--
ALTER TABLE `tarif_parkir`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_2` (`id_user`),
  ADD KEY `id_user_3` (`id_user`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `id_kendaraan` (`id_kendaraan`,`id_tarif`,`id_user`,`id_area`),
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_area` (`id_area`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_parkir`
--
ALTER TABLE `area_parkir`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12134;

--
-- AUTO_INCREMENT for table `tarif_parkir`
--
ALTER TABLE `tarif_parkir`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4568;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26060;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
