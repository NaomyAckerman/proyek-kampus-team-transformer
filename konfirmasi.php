<?php
session_start();
require 'fungsi.php';

// cek apakah sudah login apa belum
if (!isset($_SESSION['login'])) {
	header('location:index.php');
}else{
	$userID = $_SESSION['userID'];
}


// menampilkan total pemebelian
if (isset($_GET['idtransaksi'])) {
	$idtransaksi = $_GET['idtransaksi'];
	$konfirmasi = tampil("SELECT * FROM detail_transaksi a, transaksi b, user d WHERE a.transaksiID = b.transaksiID AND b.userID = $userID AND b.transaksiID = $idtransaksi GROUP BY b.transaksiID DESC")[0];
	$transaksiID = $konfirmasi['transaksiID'];
}else{
	$konfirmasi = tampil("SELECT * FROM detail_transaksi a, transaksi b, user d WHERE a.transaksiID = b.transaksiID AND b.userID = $userID GROUP BY b.transaksiID DESC")[0];
	$transaksiID = $konfirmasi['transaksiID'];
}


if (isset($_POST['upload'])) {
	if ($konfirmasi['status_pembayaran'] == 1) {
		header('location:?idtransaksi='.$idtransaksi.'');
	}else{
		if (uploadbukti() == 1) {
			$gambar = $_FILES['uploadbukti']['name'];
			mysqli_query($koneksi,"UPDATE transaksi SET
			  		gbrbukti_pembayaran = '$gambar'
					WHERE transaksiID = $transaksiID");
			if (isset($idtransaksi)) {
				echo "<script>
						alert('Berhasil Upload Bukti Pembayaran');
						document.location.href='konfirmasi.php?idtransaksi=".$idtransaksi."';
						</script>
						";
			}else{
				echo "<script>
						alert('Berhasil Upload Bukti Pembayaran');
						</script>
						";
			}
		}else{
			if (isset($idtransaksi)) {
				echo "<script>
					alert('gagal');
					document.location.href='konfirmasi.php?idtransaksi=".$idtransaksi."';
					</script>
					";
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home AVE HIJUP</title>
	<link href='img/farhan1.png' rel='shortcut icon'>
	<link rel="stylesheet" type="text/css" href="vendor/css/stylepesanan.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/all.css">
	<script src="vendor/js/jquery-3.4.1.min.js"></script>
  	<script src="vendor/js/popper.min.js"></script>
  	<script src="vendor/js/bootstrap.js"></script>
  	<script src="vendor/js/all.js"></script>
  	<script src="vendor/js/jquery.js" ></script>
	<script src="vendor/js/upload.js" ></script>
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
	  		
	  		<div class="collapse navbar-collapse collapse" id="navbarNav">
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
  				<?php 
    				//tekan tombol cari
					if (isset($_POST["cari"])) {
						$produk = cari($_POST);
						header('location:index.php?key='.$_POST["keyword"].'');
					}
    			?>
  				<form action="" method="post" class="form-inline my-2 my-lg-0 mr-5">
		      		<div class="wrapper-input">
		      			<input type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">
			      		<button class="my-sm-0" type="submit" name="cari"><i class="fas fa-search"></i></button>
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
      				<?php if (isset($_SESSION['login'])): ?>
	      				<li class="nav-item">
	        				<a href="logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
	      				</li>
      				<?php endif ?>
    			</ul>
    		</div>
	   	</div>
	</div>
</header>
</section>
	<!-- navbar akhir -->

	<!-- Konten -->
<div class="content">
	<div class="container">
		<h1 class="text-center">Pesanan Anda</h1>
		<?php 
			$detail_transaksi = tampil("SELECT * FROM detail_transaksi a, transaksi b, produk c WHERE a.transaksiID = b.transaksiID AND c.produkID = a.produkID AND a.transaksiID = $transaksiID");
			foreach ($detail_transaksi as $detail) {
				$totalproduk[] = $detail['qty'];
				$subtotal[] = $detail['subtotal'];
			}
		?>
		<div class="card">
			<div class="card-body">
				<div class="text-capitalize">
					<label>Total Produk</label>
					<label class="float-right"><?= array_sum($totalproduk); ?> Pcs</label>
				</div>
				<hr>
				<div class="text-capitalize">
					<label>produk</label>
					<?php foreach ($detail_transaksi as $p): ?>						
						<label class="float-right">
							<span class="badge badge-danger"><?= $p['qty']; ?> Pcs</span>
							<?= $p['namaproduk']; ?>
							<span class="ml-3">Rp. <?= number_format($p['harga'],2,',','.'); ?></span>
						</label>
						<br>
						<hr>
					<?php endforeach ?>
				</div>
				<div class="text-capitalize">
					<label>Total Pembayaran</label>
					<label class="float-right">Rp. <?= number_format(array_sum($subtotal),2,',','.'); ?></label>
				</div>
				<hr>
				<div class="font-weight-bold text-capitalize">
					<label>pembayaran</label>
						<ul class="list-unstyled text-uppercase float-right text-justify">
							<li>bni no.rek : 123456789</li>
							<li>bri no.rek : 123456789</li>
							<li>bca no.rek : 123456789</li>
						</ul>
						<br><br>
					<?php if ($konfirmasi['status_pembayaran'] == 0): ?>
						<label class="alert alert-danger w-100 text-center">Kode Invoice : <?= $konfirmasi['transaksiID']; ?> <br>
						Silahkan Unggah Bukti Pembayaran untuk Mendapatkan No Resi
						</label>
					<?php elseif ($konfirmasi['status_pembayaran'] == 1 AND $konfirmasi['status_pengiriman'] == 0):?>				
						<label class="alert alert-info w-100 text-center">Pesanan Anda dengan Kode Invoice : <?= $konfirmasi['transaksiID']; ?> telah dikonfirmasi</label>
						<label class="alert alert-danger w-100 text-center">Silahkan Menunggu Proses Pengiriman</label>
					<?php elseif ($konfirmasi['status_pembayaran'] == 1 AND $konfirmasi['status_pengiriman'] == 1) :?>
						<label class="alert alert-info w-100 text-center">No Resi : <?= $konfirmasi['no_resi']; ?><br>
						Kode Invoice : <?= $konfirmasi['transaksiID']; ?>
						</label>
						<label class="alert alert-success w-100 text-center">Pesanan Anda Telah Dikirim</label>
					<?php endif ?>
				</div>
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="imgUp font-weight-bold">
						<div>
							<label>Upload Bukti Pembayaran</label>
						</div>
		    			<label class="col-md-3 imagePreview float-left mt-3" for="bukti">
		    			</label>
						<div>
							<label class="btn btn-info float-right">
								Pilih Gambar<input id="bukti" type="file" class="uploadFile gambar" value="Upload Photo" name="uploadbukti">
							</label>
						</div>
					</div>
					<br>
					<button class="btn btn-primary float-right" type="submit" name="upload">Unggah</button>
				</form>
			</div>
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
				<a class="col-12" href="infosyaratdanketentuan.php">Syarat dan Ketentuan</a><br>
				<a class="col-12" href="infopengiriman.php">Info pengiriman</a><br>
				<a class="col-12" href="infocarabelanja.php">Cara belanja</a>
			</div>
			<div class="col-md-4 mt-2 mb-2">
				<a href="https://api.instagram.com/v1/self/media/recent?access_token=ACCESS_TOKEN" class="mr-3">
					<img src="img/ig1.png" width="30" height="30">
				Ave.Hijup</a>
				<a href="https://api.whatsapp.com/send?phone=6283847337988&text=&source=&data=">
					<img src="img/wa.png" width="30" height="32">
				0838-4733-7988</a>
			</div>
		</div>
	</div>
</footer>
<!-- footer akhir -->

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