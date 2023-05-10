-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2023 pada 12.36
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metopen-app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '$2y$10$Idel4ygXxk.4DXC9R8WLcu1rMBLWQLQVnP4qtLMwDSrOliEAED0Sm', '2023-04-28 07:22:09', '2023-05-06 05:37:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asal_air`
--

CREATE TABLE `asal_air` (
  `id` int(3) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asal_air`
--

INSERT INTO `asal_air` (`id`, `nama`) VALUES
(1, 'Bukit Kelam'),
(2, 'PDAM Kubu Raya'),
(3, 'Kota Bandung'),
(4, 'Tanray');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `id` int(7) NOT NULL,
  `ph_air` float(4,2) DEFAULT NULL,
  `suhu_air` float(5,2) DEFAULT NULL,
  `kekeruhan` float(5,2) DEFAULT NULL,
  `suhu_lingkungan` float(4,2) DEFAULT NULL,
  `kelembaban_lingkungan` float(5,2) DEFAULT NULL,
  `asal_air_id` int(2) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nic`
--

CREATE TABLE `nic` (
  `id` int(7) NOT NULL,
  `delay_time` int(7) DEFAULT NULL,
  `asal_air_id` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `asal_air`
--
ALTER TABLE `asal_air`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_asal_air` (`asal_air_id`);

--
-- Indeks untuk tabel `nic`
--
ALTER TABLE `nic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_asal_air_nic` (`asal_air_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `asal_air`
--
ALTER TABLE `asal_air`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data`
--
ALTER TABLE `data`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nic`
--
ALTER TABLE `nic`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `FK_asal_air` FOREIGN KEY (`asal_air_id`) REFERENCES `asal_air` (`id`);

--
-- Ketidakleluasaan untuk tabel `nic`
--
ALTER TABLE `nic`
  ADD CONSTRAINT `FK_asal_air_nic` FOREIGN KEY (`asal_air_id`) REFERENCES `asal_air` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
