<?php 

$koneksi = mysqli_connect("localhost","root","","db_avehijup");

function daftar($data){
	global $koneksi;
	$email = htmlspecialchars($data['email']);
	$password1 = htmlspecialchars($data['password1']);
	$password2 = htmlspecialchars($data['password2']);
	$alamat = htmlspecialchars($data['alamat']);
	$telepon = htmlspecialchars($data['telepon']);

	$query = "INSERT INTO user 
				VALUES
				('','1','','$email','$password1','$password2','$alamat','$telepon')
			";

	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

?>
