<?php 
$koneksi = mysqli_connect("localhost","root","","u8823774_avehijup");

// fungsi untuk menampilkan query
function tampil($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query); 
	$rows = [];
	while ($row = mysqli_fetch_array($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// fungsi tambah user baru
function daftar($data){
	global $koneksi;
	$email = htmlspecialchars($data['email']);
	$username = htmlspecialchars($data['username']);
	$password = mysqli_real_escape_string($koneksi,password_hash($data['password1'], PASSWORD_DEFAULT));
	$alamat = htmlspecialchars($data['alamat']);
	$pos = htmlspecialchars($data['pos']);
	$telepon = htmlspecialchars($data['telepon']);

	$query = "INSERT INTO user 
				VALUES
				('','$username','$telepon','$alamat','$pos','$email','$password','User','0','farhan1.png')
			";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}


// fungsi menghapus produk dalam keranjang
function hapus($id){
	global $koneksi;	
	mysqli_query($koneksi,"DELETE FROM keranjang WHERE cartID = $id");
	return mysqli_affected_rows($koneksi);
}


// fungsi menambahkan gambar testimoni
function tambah($data){
	global $koneksi;
	$ket = htmlspecialchars($data['testi']);
	$produk = htmlspecialchars($data['produk']);
	$userid = $_SESSION['userID'];
    $gambar = upload();
 	if (!$gambar) {
 		return false;
 	}
	$query = "INSERT INTO testimoni
				VALUES
				('','$gambar','$ket','$userid','$produk','0')
			";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

// fungsi cek gambar testimoni
function upload(){
	$namafile = $_FILES['gambar']['name'];
	$ukuran = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpnama = $_FILES['gambar']['tmp_name'];
	// cek apa ada gambar yang diupload
	if ($error === 4) {
			echo "<script>
	       		alert('Gambar tidak ada!!!');
     			document.location.href='uploadtesti.php';
	        </script>";
	      return false;
	}
	$extensi = ['jpg','jpeg','png'];
	$extensigambar = explode('.',$namafile);
	$extensigambar = strtolower(end($extensigambar));
	if (!in_array($extensigambar, $extensi)) {
		echo "<script>
	       		alert('Yang anda upload bukan gambar!!!');
     			document.location.href='uploadtesti.php';
	        </script>";
	      return false;
	}
	if ($ukuran > 1000000) {
		echo "<script>
	       		alert('Ukuran gambar terlalu besar!!!');
     			document.location.href='uploadtesti.php';
	        </script>";
	      return false;
	}
	$namafilebaru = uniqid();
	$namafilebaru .= '.'.$extensigambar;
	move_uploaded_file($tmpnama, 'admin/uploaded_files/'.$namafilebaru);
	return $namafilebaru;
}



// fungsi Update Profile
function uploadprofile(){
	$namafile = $_FILES['profile']['name'];
	$ukuran = $_FILES['profile']['size'];
	$error = $_FILES['profile']['error'];
	$tmpnama = $_FILES['profile']['tmp_name'];
	// cek apa ada gambar yang diupload
	if ($error === 4) {
			echo "<script>
	       		alert('Gambar tidak ada!!!');
     			document.location.href='akun.php';
	        </script>";
	      return false;
	}
	$extensi = ['jpg','jpeg','png'];
	$extensigambar = explode('.',$namafile);
	$extensigambar = strtolower(end($extensigambar));
	if (!in_array($extensigambar, $extensi)) {
		echo "<script>
	       		alert('Yang anda upload bukan gambar!!!');
     			document.location.href='akun.php';
	        </script>";
	      return false;
	}
	if ($ukuran > 1000000) {
		echo "<script>
	       		alert('Ukuran gambar terlalu besar!!!');
     			document.location.href='akun.php';
	        </script>";
	      return false;
	}
	move_uploaded_file($tmpnama, 'admin/uploaded_files/'.$namafile);
	return true;
}

// transaksi
function transaksi() {
	global $koneksi;
	$userID = $_SESSION['userID'];
	$transaksi = tampil("SELECT * FROM keranjang a, produk b, user c, kategori d WHERE
		a.produkID = b.produkID AND
		a.userID = c.userID AND
		b.kategoriID = d.kategoriID AND
		a.userID = $userID");

	foreach ($transaksi as $data) {
		$harga[] = $data['totalharga'];
		$totalharga = array_sum($harga);
		$date = date('Y-m-d');
		$alamat = $data['alamat'];
		$pos = $data['kode_pos'];
	}
	// menambahkan data transaksi
	mysqli_query($koneksi,"INSERT INTO transaksi VALUES (
		'','$userID','$totalharga','$date','$alamat','$pos','','0','','0'
		)");
}


// fungsi cek gambar Bukti Pembayaran
function uploadbukti(){
	$namafile = $_FILES['uploadbukti']['name'];
	$ukuran = $_FILES['uploadbukti']['size'];
	$error = $_FILES['uploadbukti']['error'];
	$tmpnama = $_FILES['uploadbukti']['tmp_name'];
	// cek apa ada gambar yang diupload
	if ($error === 4) {
			echo "<script>
	       		alert('Gambar tidak ada!!!');
	        </script>";
	      return false;
	}
	$extensi = ['jpg','jpeg','png'];
	$extensigambar = explode('.',$namafile);
	$extensigambar = strtolower(end($extensigambar));
	if (!in_array($extensigambar, $extensi)) {
		echo "<script>
	       		alert('Yang anda upload bukan gambar!!!');
	        </script>";
	      return false;
	}
	if ($ukuran > 1000000) {
		echo "<script>
	       		alert('Ukuran gambar terlalu besar!!!');
	        </script>";
	      return false;
	}
	move_uploaded_file($tmpnama, 'admin/uploaded_files/'.$namafile);
	return true;
}

//fungsi cari produk
function cari($keyword){
	$query = "SELECT * FROM produk
	WHERE
	namaproduk like '%$keyword%'
	";
	return tampil($query);
}
?>
