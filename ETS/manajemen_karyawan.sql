-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 05:17 PM
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
-- Database: `manajemen_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `tanggal_dibuat`) VALUES
(1, 'test', '$2y$10$E0MxZ9GaqEn5mtBR3EOfqeu7cD11itiWUUPBYLfFLj5c8tOr8FRqO', '2023-11-01 05:00:00'),
(2, 'asdf', '$2y$10$3UL07nEcctDFE9EIZu.QousE4L/O3m3nwdbXiFYsw0Wv.RHG8VhHW', '2024-11-05 13:58:16'),
(6, 'admin2', '$2y$10$DG19cFDxJTxPjsB4Jn7lruIyWKkfayAKqOiiotbXW57NUaUsarPJq', '2024-11-05 15:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `tanggal_ditambahkan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `jabatan`, `email`, `foto_profil`, `tanggal_ditambahkan`) VALUES
(4, 'test', 'direktur', 'admin@example.com', 'noid.jpg', '2024-11-05 13:13:44'),
(6, 'Jane Smith', 'Project Manager', 'jane.smith@example.com', 'atmylimit.png', '2024-11-05 13:40:06'),
(8, 'nicko', 'direktur', 'user@example.com', 'sorryilikeyou.jpg', '2024-11-05 13:49:03'),
(10, 'edward', 'test', 'edwar@gmail.com', 'default.png', '2024-11-05 13:52:05'),
(11, 'toni ', 'pakbos', 'toni@test.com', 'noid.jpg', '2024-11-05 14:20:38'),
(12, 'gavi', 'it support', 'gavi@test.com', 'default.png', '2024-11-05 14:20:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
