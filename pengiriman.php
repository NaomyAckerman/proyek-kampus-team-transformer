<?php
session_start();
require 'fungsi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home AVE HIJUP</title>
	<link href='img/farhan1.png' rel='shortcut icon'>

	<link rel="stylesheet" type="text/css" href="vendor/css/stylepengiriman.css">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	
	<script type="text/javascript" src="assets/dist/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	
<section>
<header id="navbar">
	<nav class="navbar navbar-light bg-light">
		<div class="container-fluid">
			<div>
				<a href="daftarmasuk.php"><i class="fas fa-user mr-3"></i>Assalamualaikum Masuk</a>
	  			<span>|</span>
	  			<a href="daftarmasuk.php">Daftar</a>
	  		</div>
	  		<div>
		  		<i class="fas fa-truck mr-3">	Shipping</i>
		  		<i class="far fa-star mr-3">	Kualitas Premium</i>
				<i class="fab fa-pied-piper-pp mr-3">	Harga Terjangkau</i>
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
				        	<div class="text-center">
				        		<form>
				        	<a href="" name="salmon"><i style="color: salmon" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="black"><i style="color: black" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="skyblue"><i style="color: skyblue" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="orange"><i style="color: orange" class="fas fa-circle m-2"></i></a>
				        	<br>
				        	<a href="" name="gray"><i style="color: gray" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="pink"><i style="color: pink" class="fas fa-circle m-2	"></i></a>
				        	<a href="" name="silver"><i style="color: silver" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="violet"><i style="color: violet" class="fas fa-circle m-2"></i></a>
				        	<br>
				        	<a href="" name="navy"><i style="color: navy" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="brown"><i style="color: brown" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="darkgreen"><i style="color: darkgreen" class="fas fa-circle m-2"></i></a>
				        	<a href="" name="purple"><i style="color: purple" class="fas fa-circle m-2"></i></a>
				        		</form>
				        	</div>
				          <a class="dropdown-item mt-2" href="produk.php?kategori=Pasmina">Pasmina</a>
				          <a class="dropdown-item" href="produk.php?kategori=Bella">Bella</a>
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
    			<span><a href="keranjang.php">Tas Belanja</a><i class="fas fa-shopping-cart ml-2"></i></span>
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
		<div class="judul">
		<h1 class="text-center">Penagihan & Pengiriman</h1>
		</div>
		<form action="/action_page.php" class="needs-validation" novalidate>
		<div class="row">
			<div class="col-md">
			    <div class="form-group">
			      <label for="nama">Nama Lengkap *</label>
			      <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Nama tidak boleh kosong.</div>
			    </div>
			    <div class="form-group">
			      <label for="alamat">Alamat Lengkap *</label>
			      <textarea type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat" name="alamat" required></textarea>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Alamat tidak boleh kosong.</div>
			    </div>
			   	<div class="form-group">
			      <label for="provinsi">Provinsi *</label>
			      <select name="provinsi" class="custom-select" id="provinsi" name="provinsi" required>
				    <option value="">Pilih Provinsi</option>
				    <option value="Jawa Timur">Jawa Timur</option>
				    <option value="Jawa Tengah">Jawa Tengah</option>
				    <option value="Jawa Barat">Jawa Barat</option>
				  </select>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Pilih Provinsi yang tersedia.</div>
			    </div>
			    <div class="form-group">
			      <label for="kota">Pilih Kota/Kabupaten *</label>
			      <select name="kota" class="custom-select" id="kota" name="kota" required>
				    <option value="">Kota/Kabupaten</option>
				    <option value="Jember">Jember</option>
				    <option value="Banyuwangi">Banyuwangi</option>
				    <option value="Probolinggo">Probolinggo</option>
				  </select>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Pilih Kota/Kabupaten yang tersedia.</div>
			    </div>
			    <div class="form-group">
			      <label for="email">Email *</label>
			      <input type="email" class="form-control" id="email" placeholder="avehijup@gmail.com" name="email" required>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Masukkan email dengan benar.</div>
			    </div>
		   	</div>

			<div class="col-md">
			    <div class="form-group">
			      <label for="kec">Kecamatan *</label>
			      <input type="text" class="form-control" id="kec" placeholder="Masukkan Kecamatan" name="kec" required>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Kecamatan tidak boleh kosong.</div>
			    </div>
			    <div class="form-group">
			      <label for="pos">Kode Pos *</label>
			      <input type="text" class="form-control" id="pos" placeholder="Masukkan kode pos" name="pos" required>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">Kode pos tidak boleh kosong.</div>
			    </div>
			    <div class="form-group">
			      <label for="wa">No Hp / WhatsApp *</label>
			      <input type="text" class="form-control" id="wa" placeholder="Masukkan No hp / WhatsApp" name="wa" required>
			      <div class="valid-feedback">Good.</div>
			      <div class="invalid-feedback">No Whatsapp tidak boleh kosong.</div>
			    </div>
	    		<button type="submit" name="simpan" class="rounded-pill w-100 btn btn-primary">Simpan</button>
			</div>
		</div>
		</form>
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
<script type="text/javascript" src="vendor/js/jquery.js" ></script>
<script type="text/javascript" src="vendor/js/validation.js" ></script>
</body>
</html>