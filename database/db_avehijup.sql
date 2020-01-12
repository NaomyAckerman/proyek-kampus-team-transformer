-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2019 pada 14.16
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_avehijup`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `no_detail` int(10) NOT NULL,
  `transaksiID` int(10) NOT NULL,
  `produkID` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` int(10) NOT NULL,
  `namakategori` varchar(255) NOT NULL,
  `deskripsikategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `namakategori`, `deskripsikategori`) VALUES
(1, 'Pasmina', 'Deskripsi Kategori 1'),
(2, 'Bella', 'Deskripsi Kategori 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `cartID` int(10) NOT NULL,
  `produkID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `totalharga` int(10) NOT NULL,
  `jumlahproduk` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produkID` int(10) NOT NULL,
  `namaproduk` varchar(50) NOT NULL,
  `deskripsiproduk` varchar(255) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `kategoriID` int(10) NOT NULL,
  `GambarProduk` varchar(50) NOT NULL,
  `jenisproduk` varchar(50) NOT NULL,
  `warnaproduk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produkID`, `namaproduk`, `deskripsiproduk`, `harga`, `jumlah`, `kategoriID`, `GambarProduk`, `jenisproduk`, `warnaproduk`) VALUES
(1, 'Pink Salem', 'Pasmina Pink Salem', 25000, 0, 1, 'pink-salem.jpg', 'Produk Hijab Pasmina', 'Pink'),
(2, 'Pasmina Green Pastel', 'Green Pastel Pasmina Hijab', 25000, 50, 1, 'green-pastel.jpg', 'Pasmina Hijab', 'Green Pastel'),
(3, 'Baby Blue Bella', 'Hijab Bella Baby Blue', 25000, 50, 2, 'baby-blue.jpg', 'Bella Hijab', 'Baby Blue'),
(4, 'Dark Gray Bella', 'Bella Dark Gray', 25000, 100, 2, 'dark-grey.jpg', 'Bella Dark Gray', 'Dark Gray'),
(5, 'Pasmina Army', 'Army Pasmina', 25000, 100, 1, 'army.jpg', 'Pasmina Hijab', 'Army'),
(6, 'Bella Soft Zaitun', 'Soft Zaitun Hijab', 25000, 1, 2, 'soft-zaitun.jpg', 'Hijab Bella', 'Soft Zaitun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `testimoniID` int(10) NOT NULL,
  `Gambartesti` varchar(50) NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `userID` int(10) NOT NULL,
  `produkID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksiID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `total_pembayaran` int(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(6) NOT NULL,
  `metode_pembayaran` varchar(10) NOT NULL,
  `gbrbukti_pembayaran` varchar(50) NOT NULL,
  `status_pembayaran` enum('0','1') NOT NULL,
  `status_pengiriman` enum('0','1') NOT NULL,
  `no_resi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `kode_pos` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','User') NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`no_detail`),
  ADD KEY `transaksiID` (`transaksiID`),
  ADD KEY `produkID` (`produkID`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `produkID` (`produkID`),
  ADD KEY `userID` (`userID`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkID`),
  ADD KEY `kategoriID` (`kategoriID`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`testimoniID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `produkID` (`produkID`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksiID`),
  ADD KEY `userID` (`userID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `aksesID` (`level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `no_detail` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `produkID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoniID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksiID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`transaksiID`) REFERENCES `transaksi` (`transaksiID`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategoriID`) REFERENCES `kategori` (`kategoriID`);

--
-- Ketidakleluasaan untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `testimoni` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
