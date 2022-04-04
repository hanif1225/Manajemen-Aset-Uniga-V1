-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2021 pada 04.21
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_asset`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int(11) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `id_lokasi` varchar(100) NOT NULL,
  `qr` varchar(100) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `tgl_rusak` date DEFAULT NULL,
  `tgl_digunakan` date DEFAULT NULL,
  `tgl_diperbaiki` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_barang`
--

CREATE TABLE `nama_barang` (
  `id_barang` int(11) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `merek` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_lokasi`
--

CREATE TABLE `nama_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nm_lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_lokasi`
--

INSERT INTO `nama_lokasi` (`id_lokasi`, `nm_lokasi`) VALUES
(2, 'Ruang Laboratorium'),
(3, 'Ruang Lab Komputer'),
(5, 'Perpustakaan'),
(6, 'Ruang USI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `username`, `level`) VALUES
(1, 'uniga', 'uniga@gmail.com.ac.id', 'e172dd95f4feb21412a692e73929961e', 'uniga', 'admin'),
(2, 'kepala lab', 'uniga@gmail.com.ac.id', 'e172dd95f4feb21412a692e73929961e', 'kepala lab', 'kepala lab');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indeks untuk tabel `nama_barang`
--
ALTER TABLE `nama_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `nama_lokasi`
--
ALTER TABLE `nama_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `nama_barang`
--
ALTER TABLE `nama_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `nama_lokasi`
--
ALTER TABLE `nama_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
