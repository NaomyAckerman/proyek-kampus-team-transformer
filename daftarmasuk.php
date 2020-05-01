<?php
session_start();
require 'fungsi.php';

if (isset($_SESSION['login'])) {
	$userID = $_SESSION['userID'];
}

// cek apakah memiliki cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];
	$result = mysqli_query($koneksi,"SELECT name FROM user WHERE userID = $id");
	$row = mysqli_fetch_assoc($result);
	if ($key === hash('sha256',$row["nama"])) {
			$_SESSION['login'] = true;
		}	
}

// cek apakah status sudah login
if (isset($_SESSION['login'])) {
    echo "<script> document.location.href='index.php';
          </script>";
    	  exit;
}


// Proses Login
if (isset($_POST['masuk'])) {
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$query = "SELECT * FROM user WHERE email = '$email'";
	$result	 = mysqli_query($koneksi,$query);
	$cek = mysqli_num_rows($result);
	if ($cek == 0) {
			echo "<script>
	            	alert('Email Salah!!!');
	        		document.location.href='daftarmasuk.php';
			  	</script>";
		exit;
	}
	$data = mysqli_fetch_array($result);
		if (password_verify($pass, $data["password"])) {
			$_SESSION['login'] = true;
			$_SESSION['userID'] = $data['userID'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = $data['level'];
            // set cookie (remember me)
            if (isset($_POST['ingat'])) {
            	setcookie('id',$data["userID"],time() + 60);
            	setcookie('key',hash('sha256',$data["nama"]),time() + 60);
            }

			if ($_SESSION['level']=='Admin') {
				echo "<script>
	        	alert('Admin Login Berhasil!!!');
	        		document.location.href='admin/';
			      </script>";
			      exit;
			}elseif ($_SESSION['level'] == 'User') {
				echo "<script>
	        	alert('User Login Berhasil!!!');
	        		document.location.href='index.php';
			      </script>";
			      exit;
			}
		}
		echo "<script>
	       		alert('Password Salah!!!');
	           		document.location.href='daftarmasuk.php';
			  </script>";
}


// Proses Registrasi
if (isset($_POST['daftar'])) {
	$email = $_POST['email'];
	$result = mysqli_query($koneksi,"SELECT * FROM user WHERE email = '$email'");
	$cek = mysqli_num_rows($result);
	if ($cek<=0) {
		$pas1 = $_POST['password1'];
		$pas2 = $_POST['password2'];
		if ($pas1==$pas2) {
			if (daftar($_POST)>0) {
				echo "<script>
	            		alert('akun berhasil diregistrasi!!!');
	            			document.location.href='daftarmasuk.php';
			          </script>";
			          exit;
				}
				echo "<script>
	            		alert('Registrasi Gagal !!!');
	           			document.location.href='daftarmasuk.php';
		        	  </script>";
		}
		echo "<script>
	           	alert('password tidak sama!!!');
	           	document.location.href='daftarmasuk.php';
	   	      </script>";
	}
	echo "<script>
	        alert('Email Sudah Ada!!!');
	        document.location.href='daftarmasuk.php';
	      </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home AVE HIJUP</title>
	<link href='img/farhan1.png' rel='shortcut icon'>
	<link rel="stylesheet" type="text/css" href="vendor/css/styledm.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/sb-admin-2.min.css">
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
  		<div class="card o-hidden border-0 shadow-lg my-5">
	    	<div class="card-body p-0">
        		<div class="row">
          		<div class="col-lg-6 bg-light">
          			<div class="p-5">
                		<h1 class="h4 text-gray-900 mb-4">Masuk</h1>
				        <form class="needs-validation user" novalidate method="POST" action="">
				            <div class="form-group">
				      			<label for="email">Email *</label>
				               	<input required type="email" class="form-control form-control-user" id="email" placeholder="Avehijup@gmail.com" name="email">
				      			<div class="valid-feedback">Benar.</div>
							    <div class="invalid-feedback">Email tidak boleh kosong.</div>
				            </div>
				            <div class="form-group">
				            	<label for="pass">Password *</label>
				               	<input required type="password" class="form-control form-control-user" id="pass" placeholder="Masukkan password" name="password">
				               	<div class="valid-feedback">Benar.</div>
							    <div class="invalid-feedback">Password tidak boleh kosong</div>
				            </div>
				            <hr>
				            <button class="btn btn-secondary btn-user btn-block" type="submit" name="masuk">Login</button>
				            <div class="small">
				            	<input class="mt-4 mr-2" type="checkbox" id="ingat" name="ingat">
				            	<label for="ingat">ingat saya</label>
				            </div>
				            <a href="lupapassword.php" class="small">Lupa password?</a>
				        </form>
              		</div>
          		</div>

          		<div class="col-lg-6 bg-light">
            		<div class="p-5">
		                <h1 class="h4 text-gray-900 mb-4">Daftar Baru</h1>
			            <form class="needs-validation user" novalidate method="POST" action="">
			               	<div class="form-group">
			               		<label for="emailr">Masukkan Email *</label>
			                  	<input required="" type="email" class="form-control form-control-user" id="emailr" placeholder="Avehijup@gmail.com" name="email">
			                  	<div class="valid-feedback">Good.</div>
							    <div class="invalid-feedback">Email tidak boleh kosong.</div>
			                </div>
			                <div class="form-group">
			                  	<label for="username">Masukkan Username *</label>
			                  	<input required="" type="text" class="form-control form-control-user" placeholder="Username" id="username" name="username">
			                  	<div class="valid-feedback">Benar.</div>
							    <div class="invalid-feedback">Username tidak boleh kosong.</div>
			                </div>
			               	<div class="form-group row">
			                  	<div class="col-sm-6 mb-3 mb-sm-0">
			               		<label for="pass1">Masukkan Password *</label>
			                    	<input required="" type="password" id="pass1" class="form-control form-control-user" placeholder="password" name="password1">
			                    	<div class="valid-feedback">Benar.</div>
								    <div class="invalid-feedback">Password tidak boleh kosong.</div>
			                  	</div>
			                  	<div class="col-sm-6">
			                    	<label for="pass2">Masukkan Repeat Password *</label>
			                    	<input required="" type="password" id="pass2" class="form-control form-control-user" placeholder="Repeat Password" name="password2">
			                    	<div class="valid-feedback">Benar.</div>
								    <div class="invalid-feedback">Password tidak boleh kosong.</div>
			                  	</div>
			                </div>
			               	<div class="form-group">
			                    <label for="alamat">Masukkan Alamat *</label>	
			                  	<input required="" id="alamat" type="text" class="form-control form-control-user" placeholder="Alamat" name="alamat">
			                    <div class="valid-feedback">Benar.</div>
								<div class="invalid-feedback">Alamat tidak boleh kosong.</div>
							</div>
			               	<div class="form-group">
			                    <label for="pos">Masukkan Kode Pos *</label>	
			                  	<input required="" id="pos" type="text" class="form-control form-control-user" placeholder="Kode Pos" name="pos">
			                    <div class="valid-feedback">Benar.</div>
								<div class="invalid-feedback">Kode Post tidak boleh kosong.</div>
							</div>
			                <div class="form-group">
			                    <label for="no">Masukkan No Telepone *</label>       
			                  	<input required pattern="[0-9]{1,13}" id="no" title="Mohon isi dengan maksimal 13 karakter dan hindari penggunaan huruf" type="text" class="form-control form-control-user" placeholder="Nomor Telepon" name="telepon">
			                  	<div class="valid-feedback">Benar.</div>
								<div class="invalid-feedback">Mohon isi dengan maksimal 13 karakter dan hindari penggunaan huruf.</div>
			                </div>
							<div class="small form-group form-check">
								<label>
							    <input required="" class=" form-check-input" type="checkbox" id="setuju" name="setuju">
							    <div class="ml-2">			
								Kebijakan dan Privasi
						     	</div>
						     	<div class="ml-2 valid-feedback">Benar.</div>
								<div class="ml-2 invalid-feedback">Check Berlangganan informasi AveHijup.</div>
								</label>
						     	<label class="ml-2"><i>Data pribadi Anda akan digunakan untuk mendukung pengalaman Anda di seluruh situs web ini, untuk mengelola akses ke akun Anda, dan untuk tujuan lain yang dijelaskan dalam kebijakan privasi kami.</i></label>
							</div>
			                <button class="btn btn-secondary btn-user btn-block" type="submit" name="daftar">Register</button>
			            </form>
			    	</div>
            	</div>
				</div>
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
<script type="text/javascript" src="vendor/js/bootstrap-validate.js"></script>
<script type="text/javascript" src="vendor/js/jquery.js" ></script>
<script type="text/javascript" src="vendor/js/validation.js" ></script>
</body>
</html>