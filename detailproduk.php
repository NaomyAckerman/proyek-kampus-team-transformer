<?php 
session_start();
require 'fungsi.php';
$produk = $_GET['Produk'];
if (!$produk) {
	header('location:index.php');
	exit();
}

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
}

$dataproduk = tampil("SELECT * FROM produk WHERE produkID = '$produk'");	

if (isset($_SESSION['login'])) {
	if (isset($_POST['masukkeranjang'])) {
		foreach ($dataproduk as $data) {
			$produkID = $data['produkID'];
			$harga = $data['harga'];
			$jmlproduk = $_POST['jumlah'];
			$tothrg = ($jmlproduk * $harga);
			if ($data['jumlah'] <= 0 || $jmlproduk == 0) {
					echo "<script>
							alert('Jumlah produk terlalu rendah silahkan lakukan pembelian minimal 1 pcs!');
						  </script>
							";
			}else{
				$query = "INSERT INTO keranjang 
								VALUES
								('','$produk','$userID','$tothrg','$jmlproduk')
						";
				$result = mysqli_query($koneksi,$query);
				$cek = mysqli_affected_rows($koneksi);
				if ($cek > 0) {
					echo "<script>
							alert('Produk berhasil masuk ke keranjang!!!');	
				           		document.location.href='keranjang.php';
						</script>
						";
						exit;
				}
			}
		}	
	}
} else{
	echo "<script>
		  alert('Anda belum memiliki akun silahkan lakukan registrasi!!!');
		  </script>";
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home AVE HIJUP</title>
	<link href='img/farhan1.png' rel='shortcut icon'>
	<link rel="stylesheet" type="text/css" href="vendor/css/styledp.css">
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
    			<span><a href="https://api.whatsapp.com/send?phone=6283847337988&text=%Saya%berminat%dengan%produk%AveHijup&source=&data=">Hubungi Kami</a><i class="far fa-comment-dots ml-2 mr-4"></i>
    			</span>
    				<a href="keranjang.php">Tas Belanja<i class="fas fa-shopping-cart ml-2"></i> 
				<?php if (isset($_SESSION['login'])): ?>
				<?php 
    				$result = mysqli_query($koneksi,"SELECT * FROM keranjang WHERE userID = $userID");
    				$cek = mysqli_num_rows($result);
    			 ?>
    					<?php if (!$cek == 0): ?>
    					<span style="position: absolute; margin-left: -10px; margin-top: -7px;" class="badge badge-danger"><?= $cek; ?></span>
    					<?php endif ?>
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
<div class="content">
	<div class="container">

		<div class="row">
			<?php foreach ($dataproduk as $data) { ?>
			<div class="col-md-5 overlay text-center">
					<a href="img/produk/<?= $data['GambarProduk']; ?>" target="_blank"><img class="rounded" height="280" width="250" src="img/produk/<?= $data['GambarProduk']; ?>">
					</a>
			</div>
			<div class="col-md">
					<?php if ($data['jumlah'] <= 0): ?>
						<?= "<script>
							alert('Produk Sold Out silahkan pilih produk lain!');
							document.location.href='index.php';
							</script>
							";
							exit();
						 ?>
					<?php else: ?>
						<h4 class="mt-2"><?= $data['namaproduk']; ?></h4>
						<hr>
						<h5 >Rp. <?= number_format($data['harga'],2,',','.') ?></h5>
						<p class="small">
							<?= "Ready Stock : ".$data['jumlah'];?>
			      		</p>
					<?php endif ?>
			<form class="mb-4" method="POST" action="">
				<div class="input-group mb-4">
					<div class="input-group-prepend">
						<button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="jumlah">
			            	<span><i class="fas fa-minus"></i></span>
			            </button>
			        </div>

		       		<input type="text" max="<?= $data['jumlah'] ?>" min="0" value="1" name="jumlah" class="text-center w-25 input-number">

		        	<div class="input-group-append">
		            	<button type="button" class="btn btn-success btn-number" data-type="plus" data-field="jumlah">
			            	<span><i class="fas fa-plus"></i></span>
			           	</button>
			       	</div>
			    </div>
			   	<div>
			       		<button type="submit" name="masukkeranjang" class="btn btn-primary">Masukkan ke keranjang <span><i class="fas fa-shopping-cart"></i></span></button>
			    </div>
			</form>
					<p><?= $data['deskripsiproduk'] ?></p>
					<br>
			</div>
			<?php } ?>
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