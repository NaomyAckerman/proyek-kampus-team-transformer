<?php
session_start();
require 'fungsi.php';
if (!isset($_SESSION['login'])) {
	header('location:index.php');
}

$userID = $_SESSION['userID'];
$result = mysqli_query($koneksi,"SELECT * FROM user WHERE userID = $userID");
$datauser = mysqli_fetch_assoc($result);

// update data user
if (isset($_POST['submit'])) {
	$gambar = $_FILES['profile']['name'];
	$nama = htmlspecialchars($_POST['nama']);
	$email = htmlspecialchars($_POST['email']);
	$no = htmlspecialchars($_POST['no']);
	$alamat = htmlspecialchars($_POST['alamat']);	
	$pos = htmlspecialchars($_POST['pos']);
	$oldpass = htmlspecialchars($_POST['oldpass']);	
	$password = mysqli_real_escape_string($koneksi,password_hash($_POST['newpass'], PASSWORD_DEFAULT));
	$passdb = $datauser['password'];
		if (password_verify($oldpass, $passdb)) {
			if (uploadprofile() == 1) {
			mysqli_query($koneksi,"UPDATE user SET 
				kode_pos = '$pos',
				alamat = '$alamat',
				no_telepon = '$no',
				email = '$email',
				nama = '$nama',
				password = '$password',
				foto = '$gambar' 
				WHERE userID = $userID");
			echo "<script>
				alert('berhasil');
				document.location.href='akun.php';
				</script>
				";
				exit();
		}else{
			echo "<script>
				alert('gagal');
				document.location.href='akun.php';
				</script>
				";
		}
		}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home AVE HIJUP</title>
	<link href='img/farhan1.png' rel='shortcut icon'>
	<link rel="stylesheet" type="text/css" href="vendor/css/stylea.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/css/all.css">
	<script src="vendor/js/jquery-3.4.1.min.js"></script>
  	<script src="vendor/js/popper.min.js"></script>
  	<script src="vendor/js/bootstrap.js"></script>
  	<script src="vendor/js/all.js"></script>
  	<script type="text/javascript" src="vendor/js/jquery.js" ></script>
  	<script type="text/javascript" src="vendor/js/uploadimg.js" ></script>
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
		  		<i class="fas fa-star mx-2"></i><span>Kualitas Pembelian</span>
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

<div class="content">
	<div class="container">
		<h1 class="text-center">My Profile</h1>
		<div class="card p-3">
			<div class="img text-center">
				<div class="avatar-upload">
			        <div class="avatar-preview">
			            <div id="imagePreview" style="background-image: url(admin/uploaded_files/<?= $datauser['foto']; ?>);">
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row mr-5 ml-5 p-3">
				<div class="col-md-8 col-sm-4">
					<label>Username</label>
				</div>
				<div class="col-md-4 col-sm-6">
					<label><?= $datauser['nama'] ?></label>
				</div>
			</div>
			<div class="row mr-5 ml-5 p-3">
				<div class="col-md-8 col-sm-4">
					<label>Email</label>
				</div>
				<div class="col-md-4 col-sm-6">
					<label><?= $datauser['email'] ?></label>
				</div>
			</div>
			<div class="row mr-5 ml-5 p-3">
				<div class="col-md-8 col-sm-4">
					<label>No Telepon</label>
				</div>
				<div class="col-md-4 col-sm-6">
					<label><?= $datauser['no_telepon'] ?></label>
				</div>
			</div>
			<div class="row mr-5 ml-5 p-3">
				<div class="col-md-8 col-sm-4">
					<label>Alamat</label>
				</div>	
				<div class="col-md-4 col-sm-6">
					<label><?= $datauser['alamat'] ?></label>
				</div>
			</div>
			<div class="row mr-5 ml-5 p-3">
				<div class="col-md-8 col-sm-4">
					<label>Kode Pos</label>
				</div>	
				<div class="col-md-4 col-sm-6">
					<label><?= $datauser['kode_pos'] ?></label>
				</div>
				<button class="btn btn-sm btn-primary m-3" data-toggle="modal" data-target="#ubah">Ubah</button>
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

<!-- Modal -->
<div class="modal fade" id="ubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<form action="" method="POST" enctype="multipart/form-data">
      		<div class="form-group">
      		<label class="label-control">Username</label>
      		<input value="<?= $datauser['nama']?>" class="form-control" type="text" name="nama">
      		</div>
      		<div class="form-group">
      		<label class="label-control">Email</label>
      		<input value="<?= $datauser['email']?>" class="form-control" type="email" name="email">
      		</div>
      		<div class="form-group">
      		<label class="label-control">No Telepon</label>
      		<input value="<?= $datauser['no_telepon']?>" class="form-control" type="number" name="no">
      		</div>
      		<div class="form-group">
      		<label class="label-control">Alamat</label>
      		<input value="<?= $datauser['alamat']?>" class="form-control" type="text" name="alamat">
      		</div>
      		<div class="form-group">
      		<label class="label-control">Kode Pos</label>
      		<input value="<?= $datauser['kode_pos']?>" class="form-control" type="number" name="pos">
      		</div>
      		<div class="form-group">
      		<label class="label-control">Password Lama</label>
      		<input required class="form-control" type="password" name="oldpass">
      		</div>
      		<div class="form-group">
      		<label class="label-control">Password baru</label>
      		<input required class="form-control" type="text" name="newpass">
      		</div>
      		<div class="form-group">
      		<label class="label-control">Upload Profile</label>
      		<label class="btn btn-primary"><input required type="file" name="profile"></label>
      		</div>
      		<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        	<button type="submit" name="submit" class="float-right btn btn-primary">Simpan Perubahan</button>
      		</form>
      </div>
    </div>
  </div>
</div>

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