<?php 
require 'fungsi.php';
$id = $_GET['id'];
if (hapus($id) >= 1) {
	echo "<script>
	         	alert('Produk berhasi dihapus dari keranjang!!!');
	      		document.location.href='keranjang.php';
	</script>";
}else{
	echo "<script>
	         	alert('Gagal Hapus!!!');
	      		document.location.href='keranjang.php';
	</script>";
}	
?>
