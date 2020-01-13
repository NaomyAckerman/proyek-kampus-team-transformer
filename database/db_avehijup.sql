-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2020 pada 04.49
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

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`no_detail`, `transaksiID`, `produkID`, `qty`, `harga`, `subtotal`) VALUES
(2, 2, 9, 1, 35000, 35000),
(3, 2, 7, 1, 25000, 25000),
(4, 2, 17, 1, 25000, 25000),
(5, 3, 17, 1, 25000, 25000),
(6, 4, 9, 2, 35000, 70000);

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
(8, 'Bella Square', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price  ðŸ’°Rp. 20.000'),
(9, 'Pashmina', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000');

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
  `warnaproduk` varchar(50) NOT NULL,
  `best_seller_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produkID`, `namaproduk`, `deskripsiproduk`, `harga`, `jumlah`, `kategoriID`, `GambarProduk`, `jenisproduk`, `warnaproduk`, `best_seller_status`) VALUES
(7, 'Bella Square Dark Grey', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ?Rp. 25.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 1, 8, 'dark-grey.jpg', 'Bella Square', 'Grey', '0'),
(9, 'Pashmina Soft Zaitun', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ?Rp. 35.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 0, 9, 'soft-zaitun.jpg', 'Pashmina', 'Choco', '0'),
(10, 'Bella Square Army', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ?Rp. 25.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 2, 8, 'army.jpg', 'Bella Square', 'Army', '0'),
(12, 'Bella Square Pink Salem', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ?Rp. 25.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 3, 8, 'pink-salem.jpg', 'Bella Square', 'Pink', '0'),
(13, 'Bella Square Mocca', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'mocca.jpg', 'Bella Square', 'Choco', '0'),
(15, 'Bella Square Green pastel', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'green-pastel.jpg', 'Bella Square', 'Green', '0'),
(16, 'Bella Square Lemonade', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'lemonade.jpg', 'Bella Square', 'Yellow', '0'),
(17, 'Bella Square Peanut', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 0, 8, 'peanut.jpg', 'Bella Square', 'Choco', '0'),
(18, 'Pashmina Avocado', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'avocado.jpg', 'Pashmina', 'Green', '0'),
(19, 'Pashmina Dark Choco', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 3, 9, 'dark choco.jpg', 'Pashmina', 'Choco', '0'),
(21, 'Pashmina Smoke Grey', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'smoke grey.jpg', 'Pashmina', 'Grey', '0'),
(22, 'Pashmina Tumeric', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'tumeric.jpg', 'Pashmina', 'Yellow', '0'),
(23, 'Pashmina Baby Blue', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 3, 9, 'baby-blue.jpg', 'Pashmina', 'Blue', '0'),
(24, 'Pashmina Steel Blue', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 3, 9, 'steel blue.jpg', 'Pashmina', 'Blue', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `testimoniID` int(10) NOT NULL,
  `Gambartesti` varchar(255) NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `userID` int(10) NOT NULL,
  `produkID` int(10) NOT NULL,
  `show_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`testimoniID`, `Gambartesti`, `Keterangan`, `userID`, `produkID`, `show_status`) VALUES
(4, 'army.jpg', 'Barang Uwaw', 18, 10, '1'),
(5, 'baby-blue.jpg', 'Barang cepat sampai pelayanan uwaw', 18, 23, '1'),
(6, 'smoke grey.jpg', 'Bahan Halus', 18, 21, '1');

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
  `gbrbukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('0','1') NOT NULL,
  `no_resi` varchar(20) NOT NULL,
  `status_pengiriman` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`transaksiID`, `userID`, `total_pembayaran`, `tgl_transaksi`, `alamat`, `kode_pos`, `gbrbukti_pembayaran`, `status_pembayaran`, `no_resi`, `status_pengiriman`) VALUES
(2, 18, 85000, '2020-01-13', 'Jl. Kalimas No 83', 67220, '1.PNG', '1', 'E31180878', '1'),
(3, 18, 25000, '2020-01-13', 'Jl. Kalimas No 83', 67220, '4.PNG', '0', '', '0'),
(4, 18, 70000, '2020-01-13', 'Jl. Kalimas No 83', 67220, '6.PNG', '0', '', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telepon` varchar(13) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kode_pos` int(6) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('Admin','User') NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userID`, `nama`, `no_telepon`, `alamat`, `kode_pos`, `email`, `password`, `level`, `user_status`, `foto`) VALUES
(18, 'User1', '081634916970', 'Jl. Kalimas No 83', 67220, 'user1@gmail.com', '$2y$10$3etjWFFO8JCT6PFXVNfZfOmvfJ7CI30UViq0kHXRIfFxsoMny6XIy', 'User', 0, 'farhan1.png'),
(19, 'Admin Ave Hijup', '085123123123', 'jl. mastrip 3 no 80', 67220, 'adminavehijup@gmail.com', '$2y$10$iz5TF8hpJTfJB2NWsK/GzeEIphix1fA7NGyFjrwgDveiz9yKzZ0VW', 'Admin', 1, 'farhan1.png');

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
  MODIFY `no_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `produkID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoniID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`),
  ADD CONSTRAINT `testimoni_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
