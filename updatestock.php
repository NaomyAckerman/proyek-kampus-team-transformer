<?php 
session_start();
require 'fungsi.php';
// apakah sudah login
if (!isset($_SESSION['login'])) {
	header("location:index.php");
}

$userID = $_SESSION['userID'];

// menampilkan data keranjang berdasarkan userid yang sedang login
$cekkeranjang = tampil("SELECT * FROM keranjang WHERE userID = $userID");
foreach ($cekkeranjang as $cek) {
	$cartID = $cek['cartID'];
}

// cek apakah ada keranjang kosong
if (!isset($cartID)) {
	echo "<script>
			alert('Maaf Keranjang anda kosong silahkan masukkan produk dalam keranjang');
	        document.location.href='index.php';
		  </script>";
} else{

	// menampilkan stock awal dan mengurangi stoc produk
	$stokawal = tampil("SELECT jumlah, jumlahproduk, a.produkID FROM keranjang a, produk b WHERE userID = $userID and a.produkID = b.produkID GROUP BY cartID");

	foreach ($stokawal as $data) {
		$stok = $data['jumlah'];
		$produkID = $data['produkID'];
		$jumlahbeli = $data['jumlahproduk'];
		$hasil = $stok - $jumlahbeli;
		// update stock produk
		mysqli_query($koneksi,"UPDATE produk SET jumlah = $hasil WHERE produkID = $produkID");
	}

	// fugnsi untuk menambahkan transaksi
	transaksi();

	// menampilkan data transaksiID dari tabel transaksi
	$data_transaksi = tampil("SELECT * FROM transaksi WHERE userID = $userID");
	foreach ($data_transaksi as $trx) {
		$transaksiID = $trx['transaksiID'];
	}

	// detail transaksi dari tabel keranjang
	$keranjang = tampil("SELECT * FROM keranjang, produk WHERE userID = $userID AND keranjang.produkID = produk.produkID");
	foreach ($keranjang as $data2) {
		$kprodukID = $data2['produkID'];
		$kqty = $data2['jumlahproduk'];
		$kharga = $data2['harga'];
		$ksubtotal = $data2['totalharga'];
		// insert detail transaksi
		mysqli_query($koneksi,"INSERT INTO detail_transaksi VALUES (
			'','$transaksiID','$kprodukID','$kqty','$kharga','$ksubtotal'
		)");
	}
		// hapus data produk pada tabel keranjang
		mysqli_query($koneksi,"DELETE FROM keranjang WHERE userID = $userID");

		header("location:konfirmasi.php");
}

?>