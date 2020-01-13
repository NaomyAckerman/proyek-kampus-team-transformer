<?php 
session_start();
require 'fungsi.php';

if (!isset($_SESSION['login'])) {
	header('location:index.php');
}

$userID = $_SESSION['userID'];

// query tampilkan produk yang dipilih user
$keranjang = tampil("SELECT cartID ,GambarProduk, namaproduk, harga, jumlahproduk FROM keranjang, produk WHERE produk.produkID = keranjang.produkID and userID = $userID GROUP BY cartID");

// proses penghitungan produk yg ada dalam keranjang
foreach ($keranjang as $data) {
	$jumlah = $data['jumlahproduk'];
	$total[] = $jumlah;
	$jumlahharga = $jumlah * $data['harga']; 	
	$hartot[] = $jumlahharga;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home AVE HIJUP</title>
	<link href='img/farhan1.png' rel='shortcut icon'>
	<link rel="stylesheet" type="text/css" href="vendor/css/stylek.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/all.css">
	<script src="vendor/js/jquery-3.4.1.min.js"></script>
  	<script src="vendor/js/popper.min.js"></script>
  	<script src="vendor/js/bootstrap.js"></script>
  	<script src="vendor/js/all.js"></script>
  	<script type="text/javascript" src="vendor/js/jquery.js" ></script>
</head>
<body>

<section>
<header id="navbar">
	<nav class="navbar navbar-light bg-light">
		<div class="container-fluid">
		<?php if (isset($_SESSION['login'])) :?>
			<div class="nav-item dropdown no-arrow">
              <a class="" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              	<?php $user = tampil("SELECT * FROM user WHERE userID = $userID") ?>
              	<?php foreach ($user as $u): ?>
	                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
	                	<img src="admin/uploaded_files/<?= $u['foto']; ?>" width="20" height="20" class="img-fluid rounded-circle">
	                  <strong class="mx-2">Wellcome</strong><?= $u['nama']; ?>
	                </span>	
              	<?php endforeach ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="akun.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
              </div>           

		<?php elseif (!isset($_SESSION['login'])) :?>
			<div>
				<a href="daftarmasuk.php"><i class="fas fa-user mr-3"></i>Assalamualaikum Masuk</a>
	  			<span>|</span>
	  			<a href="daftarmasuk.php">Daftar</a>
	  		</div>
		<?php endif; ?>
			<div>
		  		<i class="fas fa-truck mx-2"></i><span>Shipping</span>
		  		<i class="fas fa-star mx-2"></i><span>Kualitas Premium</span>
				<i class="fas fa-dollar-sign mx-2"></i><span>Harga Terjangkau</span>
			</div>
		</div>
	</nav>

	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container-fluid">

			<button class="btn toggler mr-5" type="submit" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span><i class="fas fa-bars"></i></span>
		    </button>

  			<a href="index.php" class="navbar-brand">Ave Hijup</a>

  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span><i class="fas fa-ellipsis-v"></i></span>
  			</button>
	  		
	  		<div class="collapse navbar-collapse" id="navbarNav">
    			<ul class="navbar-nav ml-auto mr-auto">
					<li class="nav-item dropdown ml-3">
				        <a class="nav-link warna dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          KATEGORI
				        </a>
					        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					        <?php // query menampilkan kategori
							$kategori = tampil("SELECT * FROM kategori"); ?>
					       	<?php foreach ($kategori as $data) { ?>
					          <a class="dropdown-item mt-2" href="produk.php?kategori=<?= $data['kategoriID']; ?>"><?= $data['namakategori']; ?></a>
					        <?php } ?>
					        </div>
				    </li>
      				<li class="nav-item ml-3">
        				<a class="nav-link warna" href="bestseller.php">BEST SELLER</a>
      				</li>
    			</ul>
  				<form class="form-inline my-2 my-lg-0 mr-5">
		      		<div class="wrapper-input">
		      			<input type="search" placeholder="Search" aria-label="Search" name="cari">
			      		<button class="my-sm-0" type="submit"><i class="fas fa-search"></i></button>
			      	</div>
    			</form>
    			<span><a href="https://api.whatsapp.com/send?phone=6283847337988&text=%Saya%berminat%dengan%produk%AveHijup&source=&data=">Hubungi Kami</a><i class="far fa-comment-dots ml-2 mr-4"></i></span>
				<?php 
    				$result = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE userID = $userID");
    				$cek = mysqli_num_rows($result);
    			 ?>
    			<span>
    				<a href="keranjang.php">Tas Belanja<i class="fas fa-shopping-cart ml-2"></i> 
    					<?php if (!$cek == 0): ?>
    					<span style="position: absolute; margin-left: -10px; margin-top: -7px;" class="badge badge-danger"><?= $cek; ?></span>
    					<?php endif ?>
    				</a>
    			</span>
  			</div>	  	
	  	</div>
	</nav>
	
	<div class="collapse" id="navbarToggleExternalContent">
	   	<div class="bg-dark p-4">
	   		<div class="container">
	   			<ul class="navbar-nav ml-auto mr-auto">
      				<li class="nav-item">
        				<a href="testimoni.php">Testimoni</a>
      				</li>

      				<li class="nav-item">
        				<a href="notifikasi.php">Notifikasi</a>
      				</li>
      				<li class="nav-item">
        				<a href="konfirmasi.php">Konfirmasi Pembayaran</a>
      				</li>
      				<li class="nav-item">
        				<a href="akun.php">Akun Saya</a>
      				</li>
      				<li class="nav-item">
        				<a href="infotentangkami.php">Tentang Kami</a>
      				</li>
    			</ul>
    		</div>
	   	</div>
	</div>
</header>
</section>
	<!-- navbar akhir -->


	<!-- Konten -->
<div class="content mt-5">
	<div class="container">

		<h1 class="text-center mb-4">Keranjang</h1>
		<div class="row">
			<div class="col-md">
				<?php 
				$numcol = 1;
				$countrow = 0;
				$colwidth = 12 / $numcol;
				?>
				<div class="row">
				<?php foreach ($keranjang as $data) { ?>
						<div class="col-md text-center">
							<img class="rounded" src="admin/uploaded_files/<?= $data['GambarProduk'] ?>" height="230" width="200">	
						</div>
						<div class="col-md mt-3">
							<h5><?= $data['namaproduk'] ?></h5>
							<h4>Rp. <?= number_format($data['harga'],2,',','.') ?></h4>
							<p>Jumlah = <?= $data['jumlahproduk']; ?></p>
							<a href="hapuskeranjang.php?id=<?=$data['cartID']?>" class="btn btn-danger">Hapus</a>
						</div>
				<?php 
				$countrow++;
				if ($countrow % $numcol == 0)
					echo '</div><div class="row"><hr>';
				}
				 ?>
				</div>
			</div>

			<div class="col-md">
				<div class="card mt-5">
					<div class="card-header text-center">
						<p>Total pembelian</p>
					</div>
					<div class="card-body">
					<?php if(count($keranjang) > 0){ ?>
						<table >
							<tr>
								<th>Jumlah Beli</th>
								<td></td>
								<td>:</td>
								<td></td>
								<td><?= array_sum($total);?></td>
							</tr>
							<tr>
								<td colspan="5"><hr class="w-100"></td>
							</tr>
							<tr>
								<th>Total Harga</th>
								<td></td>
								<td>:</td>
								<td></td>
								<td><?= array_sum($hartot);?></td>
							</tr>
						</table>
					<?php } ?>
						<div class="text-right">
						<a href="updatestock.php" class="btn btn-danger">Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>
		<div>
			<a href="index.php" class="btn btn-info">Lanjut Belanja</a>
		</div>
	</div>
</div>
	<!-- Konten akhir -->

<!-- footer -->
<footer class="mt-5">
	<div class="container">
		<div class="row text-center align-items-center">
			<div class="col-md-4 mt-2 mb-2">
				<img class="mr-3" src="img/bni.png" width="60" height="20">
				<img class="mr-3" src="img/bri.png" width="60" height="20">
				<img src="img/bca.png" width="60" height="50">
			</div>
			<div class="col-md-4 mt-3">
				<h5>INFORMASI</h5>
				<hr class="w-50 mt-2">
				<a class="btn col-12" href="infosyaratdanketentuan.php">Syarat dan Ketentuan</a>
				<a class="btn col-12" href="infopengiriman.php">Info pengiriman</a>
				<a class="btn col-12" href="infocarabelanja.php">Cara belanja</a>
			</div>
			<div class="col-md-4 mt-2 mb-2">
				<a href="" class="mr-3">
					<img src="img/ig1.png" width="30" height="30">
				Ave.Hijup</a>
				<a href="https://api.whatsapp.com/send?phone=6283847337988&text=%Saya%berminat%dengan%produk%AveHijup&source=&data=">
					<img src="img/wa.png" width="30" height="32">
				0838-4733-7988</a>
			</div>
		</div>
	</div>
</footer>

<!-- modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apa anda ingin keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik tombol keluar untuk berganti akun.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
          <a class="btn btn-primary" href="logout.php">Keluar</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>