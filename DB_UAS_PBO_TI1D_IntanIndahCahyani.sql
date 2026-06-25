-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 06:38 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1d_intanindahcahyani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` int NOT NULL,
  `jenis_pembayaran` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) DEFAULT NULL,
  `dana_saku_subsidi` int DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_bersyarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembayaran`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_bersyarat`) VALUES
(1, 'Intan Indah Cahyani', '220101001', 4, 3500000, 'mandiri', 'Golongan 3', 'Budi Cahyono', NULL, NULL, NULL, NULL),
(2, 'Rian Hidayat', '220101002', 4, 4500000, 'mandiri', 'Golongan 4', 'Joko Susanto', NULL, NULL, NULL, NULL),
(3, 'Siti Aminah', '220101003', 2, 3500000, 'mandiri', 'Golongan 3', 'Ahmad Subarjo', NULL, NULL, NULL, NULL),
(4, 'Eko Prasetyo', '220101004', 6, 5500000, 'mandiri', 'Golongan 5', 'Heri Setiawan', NULL, NULL, NULL, NULL),
(5, 'Dewi Lestari', '220101005', 2, 2500000, 'mandiri', 'Golongan 2', 'Supardi', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugroho', '220101006', 4, 4500000, 'mandiri', 'Golongan 4', 'Mulyono', NULL, NULL, NULL, NULL),
(7, 'Adi Wijaya', '220101007', 6, 3500000, 'mandiri', 'Golongan 3', 'Bambang Tri', NULL, NULL, NULL, NULL),
(8, 'Ahmad Fauzi', '220101008', 4, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2024-001', 700000, NULL, NULL),
(9, 'Gita Permata', '220101009', 2, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2025-042', 700000, NULL, NULL),
(10, 'Rina Marlina', '220101010', 6, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2023-112', 800000, NULL, NULL),
(11, 'Deni Setiawan', '220101011', 4, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2024-089', 700000, NULL, NULL),
(12, 'Hendra Wijaya', '220101012', 4, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2024-055', 700000, NULL, NULL),
(13, 'Indah Cahyani', '220101013', 2, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2025-019', 700000, NULL, NULL),
(14, 'Joko Tarub', '220101014', 6, 2400000, 'bidikmisi', NULL, NULL, 'KIP-2023-201', 800000, NULL, NULL),
(15, 'Kevin Sanjaya', '220101015', 4, 4000000, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(16, 'Larasati Putri', '220101016', 4, 4000000, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.25),
(17, 'Muhammad Riski', '220101017', 2, 4000000, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Pemprov Jateng', 3.40),
(18, 'Nadia Vega', '220101018', 6, 4500000, 'prestasi', NULL, NULL, NULL, NULL, 'PT Adaro Energy', 3.50),
(19, 'Dimas Anggara', '220101019', 4, 4000000, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', 3.75),
(20, 'Siti Badriah', '220101020', 2, 4000000, 'prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(21, 'Yusuf Mansur', '220101021', 6, 4500000, 'prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
