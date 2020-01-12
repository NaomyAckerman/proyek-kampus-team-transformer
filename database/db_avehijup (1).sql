-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2019 at 08:11 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

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
-- Table structure for table `detail_transaksi`
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
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`no_detail`, `transaksiID`, `produkID`, `qty`, `harga`, `subtotal`) VALUES
(1, 1, 5, 1, 50000, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` int(10) NOT NULL,
  `namakategori` varchar(255) NOT NULL,
  `deskripsikategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `namakategori`, `deskripsikategori`) VALUES
(8, 'Kategori 1', 'Deskripsi Kategori 1'),
(9, 'Kategori 2', 'Deskripsi Kategori 2'),
(10, 'venna', 'cantik banget dalam mmpi');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
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
-- Table structure for table `produk`
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
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produkID`, `namaproduk`, `deskripsiproduk`, `harga`, `jumlah`, `kategoriID`, `GambarProduk`, `jenisproduk`, `warnaproduk`, `best_seller_status`) VALUES
(5, 'Produk 1', 'zxzx', 10000, 20, 9, 't.png', 'Bella Square', 'Abu-Abu', '1'),
(6, 'bellasquare abu', 'bgus', 30000, 7, 9, 'logo baru av.png', 'Bella Square', 'Abu-Abu', '0');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
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
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`testimoniID`, `Gambartesti`, `Keterangan`, `userID`, `produkID`, `show_status`) VALUES
(1, 'ZZZ', 'ZZZ', 8, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksiID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `total_pembayaran` int(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(6) NOT NULL,
  `deadline_pembayaran` date NOT NULL,
  `metode_pembayaran` varchar(10) NOT NULL,
  `gbrbukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('0','1') NOT NULL,
  `kurir_pengiriman` varchar(10) DEFAULT NULL,
  `no_resi` varchar(20) NOT NULL,
  `status_pengiriman` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksiID`, `userID`, `total_pembayaran`, `tgl_transaksi`, `alamat`, `kode_pos`, `deadline_pembayaran`, `metode_pembayaran`, `gbrbukti_pembayaran`, `status_pembayaran`, `kurir_pengiriman`, `no_resi`, `status_pengiriman`) VALUES
(1, 8, 50000, '2019-12-12', 'Jalan Kapten ZZZ', 672172, '2019-12-14', 'BRI', 't.png', '1', '', '1212', '1'),
(2, 8, 1000000, '2019-12-18', '1aasas', 1212, '2019-12-20', 'BRI', 'zzzz', '1', 'TIKI', '1212', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `nama`, `no_telepon`, `alamat`, `kode_pos`, `email`, `password`, `level`, `user_status`, `foto`) VALUES
(8, 'Dimas Yudha Pratamaz', NULL, NULL, NULL, 'dyp.dimasyp@gmail.comz', '$2y$10$XCSQIoxEk1ApcrqZmVMELOEDmDUGYjCf8DaDGCAXMaaevSpnw8vG2', 'Admin', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`no_detail`),
  ADD KEY `transaksiID` (`transaksiID`),
  ADD KEY `produkID` (`produkID`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `produkID` (`produkID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkID`),
  ADD KEY `kategoriID` (`kategoriID`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`testimoniID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `produkID` (`produkID`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksiID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `aksesID` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `no_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produkID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoniID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`transaksiID`) REFERENCES `transaksi` (`transaksiID`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategoriID`) REFERENCES `kategori` (`kategoriID`);

--
-- Constraints for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD CONSTRAINT `testimoni_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`),
  ADD CONSTRAINT `testimoni_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
