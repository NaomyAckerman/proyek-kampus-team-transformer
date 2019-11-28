<?php
require 'fungsi.php';
if (isset($_POST['daftar'])) {
	$pas1 = $_POST['password1'];
	$pas2 = $_POST['password2'];
	if ($pas1==$pas2) {
		if (daftar($_POST)>0) {
			echo "<script>
            alert('akun berhasil diregistrasi!!!');
            document.location.href='#';
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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
	<link rel="stylesheet" type="text/css" href="styledm.css">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
 	<link href="sb-admin-2.min.css" rel="stylesheet">
	
	<script type="text/javascript" src="assets/dist/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body>

	<!-- navbar -->

<header class="sticky-top">
	<nav class="navbar  navbar-light bg-light">
		<div class="container-fluid">
			<div>
				<a href=""><i class="fas fa-user mr-3"></i>Assalamualaikum Masuk</a>
	  			<span>|</span>
	  			<a href="">Daftar</a>
	  		</div>
	  		<div>
		  		<i class="fas fa-truck mr-3">	Shipping</i>
		  		<i class="far fa-star mr-3">	Kualitas Pembelian</i>
				<i class="fab fa-pied-piper-pp mr-3">	Harga Terjangkau</i>
			</div>
		</div>
	</nav>

	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container-fluid">

			<button class="btn toggler mr-5" type="submit" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span><i class="fas fa-bars"></i></span>
		    </button>

  			<a href="login.html" class="navbar-brand">Ave Hijup</a>

  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span><i class="fas fa-ellipsis-v"></i></span>
  			</button>
	  		
	  		<div class="collapse navbar-collapse" id="navbarNav">
    			<ul class="navbar-nav ml-auto mr-auto">
      				<li class="nav-item ml-5">
        				<a href="#">KATEGORI</a>
      				</li>
      				<li class="nav-item ml-5">
        				<a href="#">BEST SELLER</a>
      				</li>
    			</ul>
  				<form class="form-inline my-2 my-lg-0 mr-5">
		      		<div>
		      			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			      		<button class="btn btn-secondary my-2 my-sm-0 rounded-pill" type="submit"><i class="fas fa-search"></i></button>
			      	</div>
    			</form>
    			<span><a href="">Hubungi Kami</a><i class="far fa-comment-dots ml-2 mr-4"></i></span>
    			<span><a href="">Tas Belanja</a><i class="fas fa-shopping-cart ml-2"></i></span>
  			</div>
	  	
	  	</div>
	</nav>
	<div class="collapse" id="navbarToggleExternalContent">
	   	<div class="bg-dark p-4">
	   		<div class="container">
	   			<ul class="navbar-nav ml-auto mr-auto">
      				<li class="nav-item">
        				<a href="#">Testimoni</a>
      				</li>
      				<li class="nav-item">
        				<a href="#">Notifikasi</a>
      				</li>
      				<li class="nav-item">
        				<a href="#">Konfirmasi Pembayaran</a>
      				</li>
      				<li class="nav-item">
        				<a href="#">Akun Saya</a>
      				</li>
      				<li class="nav-item">
        				<a href="#">Tentang Kami</a>
      				</li>
    			</ul>
    		</div>
	   	</div>
	</div>
</header>

	<!-- navbar akhir -->


	<!-- Konten -->

<div class="content">
	<div class="container">
  		<div class="card o-hidden border-0 shadow-lg my-5">
	    	<div class="card-body p-0">
        		<div class="row">
          		<div class="col-lg-6 bg-light">
          			<div class="p-5">
                		<h1 class="h4 text-gray-900 mb-4">Login</h1>
				        <form class="user" method="POST" action="">
				            <div class="form-group">
				               	<input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email">
				            </div>
				            <div class="form-group">
				               	<input type="password" class="form-control form-control-user" placeholder="Password">
				            </div>
				            <hr>
				            <button class="btn btn-secondary btn-user btn-block" type="masuk">Login</button>
				            <div class="small">
				            	<input class="mt-4 mr-2" type="checkbox" id="ingat" name="ingat">
				            	<label for="ingat">ingat saya</label>
				            </div>
				            <a href="" class="small">Lupa password?</a>
				        </form>
              		</div>
          		</div>

          		<div class="col-lg-6 bg-light">
            		<div class="p-5">
		                <h1 class="h4 text-gray-900 mb-4">Register</h1>
			            <form class="user" method="POST" action="">
			               	<div class="form-group">
			                  	<input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email" name="email">
			                </div>
			               	<div class="form-group row">
			                  	<div class="col-sm-6 mb-3 mb-sm-0">
			                    	<input type="password" class="form-control form-control-user" placeholder="password" name="password1">
			                  	</div>
			                  	<div class="col-sm-6">
			                    	<input type="password" class="form-control form-control-user" placeholder="Repeat Password" name="password2">
			                  	</div>
			                </div>
			               	<div class="form-group">
			                  	<input type="text" class="form-control form-control-user" placeholder="Address" name="alamat">
			                </div>
			                <div class="form-group">
			                  	<input type="text" class="form-control form-control-user" placeholder="Nomor Telepon" name="telepon">
			                </div>
							<div class="small">
							    <input class="m-2" type="checkbox" id="setuju" name="setuju">
						     	<label for="setuju">I agree to the Terms of service
						     	</label>
						     	<label class="ml-2 mb-3"><i>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						     	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</i></label>
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

<footer>
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
				<a class="btn col-12" href="">Syarat dan Ketentuan</a>
				<a class="btn col-12" href="">Info pengiriman</a>
				<a class="btn col-12" href="">Cara belanja</a>
			</div>
			<div class="col-md-4 mt-2 mb-2">
				<a href="" class="mr-3">
					<img src="img/ig1.png" width="30" height="30">
				Ave.Hijup</a>
				<a href="">
					<img src="img/wa.png" width="30" height="32">
				0838-4733-7988</a>
			</div>
		</div>
	</div>
</footer>

	<!-- footer akhir -->

</body>
</html>