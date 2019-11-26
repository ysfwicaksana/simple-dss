-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 04:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE `beasiswa` (
  `id` int(11) NOT NULL,
  `tahun_akademik` varchar(9) NOT NULL,
  `siswa` int(11) NOT NULL,
  `nem` varchar(100) NOT NULL,
  `prestasi` varchar(100) NOT NULL,
  `penghasilan` varchar(100) NOT NULL,
  `tanggungan` varchar(100) NOT NULL,
  `jarak_rumah` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`id`, `tahun_akademik`, `siswa`, `nem`, `prestasi`, `penghasilan`, `tanggungan`, `jarak_rumah`, `created_at`) VALUES
(9, '2019', 6, 'Diatas 36.00', 'Tingkat Kecamatan', 'Dibawah Rp.800.000,-', '4 anak', 'Dekat', '2019-11-13 15:33:21'),
(10, '2019', 7, '35.99 - 32.00', 'Tidak Berprestasi', 'Diatas Rp.3.000.000,-', 'Lebih dari 5 anak', 'Jauh', '2019-11-13 15:34:02'),
(11, '2019', 8, 'Diatas 36.00', 'Tingkat Kabupaten', 'Dibawah Rp.800.000,-', 'Lebih dari 5 anak', 'Sedang', '2019-11-13 15:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `matrik_keputusan`
--

CREATE TABLE `matrik_keputusan` (
  `id` int(11) NOT NULL,
  `beasiswa` int(11) NOT NULL,
  `nem` decimal(10,2) NOT NULL,
  `prestasi` decimal(10,2) NOT NULL,
  `penghasilan` decimal(10,2) NOT NULL,
  `tanggungan` decimal(10,2) NOT NULL,
  `jarak_rumah` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matrik_keputusan`
--

INSERT INTO `matrik_keputusan` (`id`, `beasiswa`, `nem`, `prestasi`, `penghasilan`, `tanggungan`, `jarak_rumah`, `created_at`) VALUES
(10, 9, '1.00', '0.40', '1.00', '0.80', '0.33', '2019-11-13 15:33:21'),
(11, 10, '0.75', '0.20', '0.25', '1.00', '1.00', '2019-11-13 15:34:02'),
(12, 11, '1.00', '0.60', '1.00', '1.00', '0.66', '2019-11-13 15:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `wali` varchar(100) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nis`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `alamat`, `wali`, `pekerjaan`, `telepon`, `created_at`) VALUES
(6, '19001', 'siswa1', 'Cikarang', '2019-11-01', 'L', 'cikarang', 'walisiswa1', 'pekerjaan1', '032832', '2019-11-13 15:30:53'),
(7, '19002', 'siswa2', 'Cikarang', '2019-11-13', 'L', 'cikarang', 'walisiswa1', 'pekerjaan1', '032832', '2019-11-13 15:31:29'),
(8, '19003', 'siswa3', 'Cikarang', '2019-11-07', 'P', 'eteaa', 'walisiswa1', 'pekerjaan1', '032832', '2019-11-13 15:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `created_at`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '2019-11-08 03:30:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_siswa` (`siswa`);

--
-- Indexes for table `matrik_keputusan`
--
ALTER TABLE `matrik_keputusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_beasiswa` (`beasiswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beasiswa`
--
ALTER TABLE `beasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `matrik_keputusan`
--
ALTER TABLE `matrik_keputusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beasiswa`
--
ALTER TABLE `beasiswa`
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matrik_keputusan`
--
ALTER TABLE `matrik_keputusan`
  ADD CONSTRAINT `fk_beasiswa` FOREIGN KEY (`beasiswa`) REFERENCES `beasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
