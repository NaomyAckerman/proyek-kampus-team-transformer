<?php
if(isset($_POST['btnSimpan'])){
    $produkID = mysqli_real_escape_string($koneksi, $_POST['produkID']);
    $kategoriID = mysqli_real_escape_string($koneksi, $_POST['kategoriID']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $jenis_produk = mysqli_real_escape_string($koneksi, $_POST['jenis_produk']);
    $warna_produk = mysqli_real_escape_string($koneksi, $_POST['warna_produk']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    if(!empty($_FILES['gambar']['name'])){
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.',$gambar);
        $ekstensi = strtolower(end($x));
        $ekstensi_allowed = array('png','jpg','jpeg');
        $gambar_tmp = $_FILES['gambar']['tmp_name'];

        
        if(in_array($ekstensi,$ekstensi_allowed)){ //Jika Extensi File Diperbolehkan
            $update = mysqli_query($koneksi,"UPDATE produk SET kategoriID='$kategoriID', namaproduk='$nama_produk', harga='$harga', jumlah='$jumlah', 
            GambarProduk='$gambar', jenisproduk='$jenis_produk', warnaproduk='$warna_produk' WHERE produkID='$produkID'");
            move_uploaded_file($gambar_tmp, 'uploaded_files/'.$gambar);
        }else{ //Jika Ekstensi File Tidak diperbolehkan
            echo "<script>window.location.href='?pages=input_produk&edit_stat=false&message=Format File Tidak Diperbolehkan'</script>";
        }
    }else{
        $update = mysqli_query($koneksi,"UPDATE produk SET kategoriID='$kategoriID', namaproduk='$nama_produk', harga='$harga', jumlah='$jumlah',
        jenisproduk='$jenis_produk', warnaproduk='$warna_produk' WHERE produkID='$produkID'");
    }

    if($update){
        echo "<script>window.location.href='?pages=edit_produk&edit_stat=1&id=".$produkID."'</script>";
    }else{
        echo "<script>window.location.href='?pages=edit_produk&edit_stat=0&id=".$produkID."'</script>";
        echo mysqli_error($koneksi);
    }

    // //Jika Extensi File Diperbolehkan
    // if(in_array($ekstensi,$ekstensi_allowed)){
    //     if(isset($_FILES['gambar']['name'])){
    //         //Script Untuk Insert Ke Tabel Produk
    //         $update = mysqli_query($koneksi,"UPDATE produk SET kategoriID='$kategoriID', namaproduk='$nama_produk', harga='$harga', jumlah='$jumlah', 
    //         GambarProduk='$gambar', jenisproduk='$jenis_produk', warnaproduk='$warna_produk' WHERE produkID=''");
    //     // $insert = mysqli_query($koneksi, "INSERT INTO produk (kategoriID, namaproduk, harga, jumlah, GambarProduk, jenisproduk, warnaproduk) 
    //     // VALUES ('$kategoriID', '$nama_produk', '$harga', '$jumlah', '$gambar', '$jenis_produk', '$warna_produk')");
    //         //Menyimpan Produk di direktori uploaded_files
    //         move_uploaded_file($gambar_tmp, 'uploaded_files/'.$gambar);
    //     }else{
            
    //     }
        
    // }else{ //Jika Ekstensi File Tidak diperbolehkan
    //     echo "<script>window.location.href='?pages=input_produk&edit_stat=false&message=Format File Tidak Diperbolehkan'</script>";
    // }
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Produk</h6>
        </div>
        <div class="card-body">
        <?php
            if(isset($_GET['edit_stat'])){
                if($_GET['edit_stat']==1){
                    echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Berhasil Diubah!!</div>";
                }else if($_GET['edit_stat']==0){
                    echo "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Gagal Diubah!!</div>";
                }
            }
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="produkID" value="<?php echo $_GET['id']; ?>">
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM produk WHERE produkID='$_GET[id]'");
                while($val = mysqli_fetch_array($query)){
                ?>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Kategori</label>
                        <select name="kategoriID" id="kategoriID" class="form-control" required="">
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT kategoriID, namakategori FROM kategori");
                            while($data = mysqli_fetch_array($query)){
                        ?>
                            <option value='<?php echo $data['kategoriID']; ?>' <?php if($data['kategoriID'] == $val['kategoriID']){echo "Selected";} ?>><?php echo $data['namakategori']; ?></option>
                        <?php  } ?>
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk" value="<?php echo $val['namaproduk'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga" value="<?php echo $val['harga'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah Stok" value="<?php echo $val['jumlah'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Jenis Produk</label>
                        <select name="jenis_produk" id="jenis_produk" class="form-control" required>
                            <option value="Bella Square" <?php if($val['jenisproduk'] == "Bella Square"){echo "Selected";} ?>>Bella Square</option>
                            <option value="Pashmina" <?php if($val['jenisproduk'] == "Pashmina"){echo "Selected";} ?>>Pashmina</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Warna Produk</label>
                        <select name="warna_produk" id="warna_produk" class="form-control" required>
                            <option value="Abu-Abu" <?php if($val['warnaproduk'] == "Abu-Abu"){echo "Selected";} ?>>Abu-Abu</option>
                            <option value="Hitam" <?php if($val['warnaproduk'] == "Hitam"){echo "Selected";} ?>>Hitam</option>
                            <option value="Merah" <?php if($val['warnaproduk'] == "Merah"){echo "Selected";} ?>>Merah</option>
                            <option value="Putih" <?php if($val['warnaproduk'] == "Putih"){echo "Selected";} ?>>Putih</option>
                            <option value="Kuning" <?php if($val['warnaproduk'] == "Kuning"){echo "Selected";} ?>>Kuning</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Deskripsi Pproduk</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" style="width: 100%; height: 80px;" placeholder="Masukkan Deskripsi Produk" required><?php echo $val['deskripsiproduk']; ?></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <input type="submit" class="btn btn-primary btn-sm" name="btnSimpan" value="Simpan">
                    </div>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>

</div>