-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 12:36 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

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
(8, 'Bella Square', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price  ðŸ’°Rp. 20.000'),
(9, 'Pashmina', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000');

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
(7, 'Bella Square Dark Grey', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ?Rp. 25.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'dark-grey.jpg', 'Bella Square', 'Grey', '0'),
(9, 'Pashmina Soft Zaitun', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ?Rp. 35.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'soft-zaitun.jpg', 'Pashmina', 'Choco', '0'),
(10, 'Bella Square Army', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ?Rp. 25.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 2, 8, 'army.jpg', 'Bella Square', 'Army', '0'),
(12, 'Bella Square Pink Salem', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ?Rp. 25.000?\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 3, 8, 'pink-salem.jpg', 'Bella Square', 'Pink', '0'),
(13, 'Bella Square Mocca', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'mocca.jpg', 'Bella Square', 'Choco', '0'),
(15, 'Bella Square Green pastel', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'green-pastel.jpg', 'Bella Square', 'Green', '0'),
(16, 'Bella Square Lemonade', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'lemonade.jpg', 'Bella Square', 'Yellow', '0'),
(17, 'Bella Square Peanut', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 4, 8, 'peanut.jpg', 'Bella Square', 'Choco', '0'),
(18, 'Pashmina Avocado', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'avocado.jpg', 'Pashmina', 'Green', '0'),
(19, 'Pashmina Dark Choco', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 3, 9, 'dark choco.jpg', 'Pashmina', 'Choco', '0'),
(21, 'Pashmina Smoke Grey', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'smoke grey.jpg', 'Pashmina', 'Grey', '0'),
(22, 'Pashmina Tumeric', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'tumeric.jpg', 'Pashmina', 'Yellow', '0'),
(23, 'Pashmina Baby Blue', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 3, 9, 'baby-blue.jpg', 'Pashmina', 'Blue', '0'),
(24, 'Pashmina Steel Blue', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 3, 9, 'steel blue.jpg', 'Pashmina', 'Blue', '0'),
(25, 'Bella Square Black', 'Best material Polly Cotton\r\nUkuran 115 X 115\r\nBest price cuma ðŸ’°Rp. 25.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 25000, 3, 8, 'black.jpg', 'Bella Square', 'Black', '0'),
(26, 'Pashmina Dusty Pink', 'Best material Premium Ceruti\r\nUkuran 175 X 175\r\nBest price cuma ðŸ’°Rp. 35.000â¤\r\nBahan sangat lembut dan nyaman dipakai\r\nSerta dijahit rapi dibagian pinggir', 35000, 4, 9, 'dustypink.jpg', 'Pashmina', 'Pink', '0');

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
(1, 'ZZZ', 'ZZZ', 8, 5, '0');

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
(8, 'Venna Ersis Relita', NULL, NULL, NULL, 'veersisr@gmail.com', '$2y$10$XCSQIoxEk1ApcrqZmVMELOEDmDUGYjCf8DaDGCAXMaaevSpnw8vG2', 'Admin', 1, NULL),
(9, 'vennaers', '083847337998', 'Jl.Kalimantan', 67355, 'veersisrel@gmail.com', '$2y$10$p.nsAGDmqTwR6QcJwrMAeeCljeBuopGjDtiPZszRLx9sC7Ya0UZ5e', 'User', 1, '1525447711811.jpg'),
(10, 'Ellen Melinda', NULL, NULL, NULL, 'ellenmelinda99@gmail.com', '$2y$10$HQWABu9WgbGBbS3XedBKDupzZxucjcOs0jiaLqfLdwYVqqIoebMsS', 'Admin', 1, NULL),
(11, 'melan', '0834567', 'Jl.Gajahmada', 6677, 'melania@gmail.com', '$2y$10$wQvp4aB9GoZGaxeSk1Tg/uc0lMBSQigr8v03nZZgSMn02Up.Mzp8y', 'User', 1, 'farhan1.png'),
(12, 'E31180678@mif', '123123123123', 'Lumajang', 6677, 'dyp.dimasyp@gmail.com', '$2y$10$tKmYt9Nc0TVoUtWhoOMDbu8cnAXYKhXz8bg.uUKQ57nMJB6hNwRo6', 'User', 1, 'farhan1.png'),
(13, 'Melania', NULL, NULL, NULL, 'melaniahnh@gmail.com', '$2y$10$LQDm19WJNoMbV9jJR6Mj4.xVw9ZMTO5yQ235fOHwnh98s9zE/0ASG', 'Admin', 0, NULL);

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
  MODIFY `no_detail` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategoriID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `cartID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produkID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoniID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksiID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
