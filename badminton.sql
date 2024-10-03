-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221125.2e001c186a
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2023 pada 09.14
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `badminton`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penyewaan`
--

CREATE TABLE `t_penyewaan` (
  `no` int(255) NOT NULL,
  `nama_penyewa` varchar(255) NOT NULL,
  `jam_sewa` varchar(20) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_penyewaan`
--

INSERT INTO `t_penyewaan` (`no`, `nama_penyewa`, `jam_sewa`, `hari`, `status`) VALUES
(1, 'Ali', '08:00', 'Senin', 'Biasa'),
(2, 'Hasan', '13:00', 'Selasa', 'Member'),
(3, 'Badu', '19:00', 'Kamis', 'Biasa'),
(4, 'Sapri', '21:00', 'Minggu', 'Biasa'),
(5, 'Ali', '18:40', 'Senin', 'Member');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
