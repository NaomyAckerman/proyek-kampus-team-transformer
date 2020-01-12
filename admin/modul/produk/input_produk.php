<?php
if(isset($_POST['btnSimpan'])){
    $kategoriID = mysqli_real_escape_string($koneksi, $_POST['kategoriID']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $jenis_produk = mysqli_real_escape_string($koneksi, $_POST['jenis_produk']);
    $warna_produk = mysqli_real_escape_string($koneksi, $_POST['warna_produk']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.',$gambar);
    $ekstensi = strtolower(end($x));
    $ekstensi_allowed = array('png','jpg','jpeg');
    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    //Jika Extensi File Diperbolehkan
    if(in_array($ekstensi,$ekstensi_allowed)){
        //Script Untuk Insert Ke Tabel Produk
        $insert = mysqli_query($koneksi, "INSERT INTO produk (kategoriID, namaproduk, deskripsiproduk, harga, jumlah, GambarProduk, jenisproduk, warnaproduk) 
        VALUES ('$kategoriID', '$nama_produk', '$deskripsi', '$harga', '$jumlah', '$gambar', '$jenis_produk', '$warna_produk')");
        //Menyimpan Produk di direktori uploaded_files
        move_uploaded_file($gambar_tmp, 'uploaded_files/'.$gambar);
        if($insert){
            echo "<script>window.location.href='?pages=input_produk&add_stat=1'</script>";
        }else{
            echo "<script>window.location.href='?pages=input_produk&add_stat=0'</script>";
            echo mysqli_error($koneksi);
        }
    }else{ //Jika Ekstensi File Tidak diperbolehkan
        echo "<script>window.location.href='?pages=input_produk&add_stat=0&message=Format File Tidak Diperbolehkan'</script>";
    }
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Input Produk</h6>
        </div>
        <div class="card-body">
            <?php
            if(isset($_GET['add_stat'])){
                if($_GET['add_stat']==1){
                    echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Berhasil Ditambahkan!!</div>";
                }else if($_GET['add_stat']==0){
                    if(isset($_GET['message'])){
                        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$_GET['message']."</div>";
                    }else{
                        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Gagal Ditambahkan!!</div>";
                    }
                }
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Kategori</label>
                        <select name="kategoriID" id="kategoriID" class="form-control" required="">
                            <option value="">Pilih Kategori</option>
                        <?php 
                            $query = mysqli_query($koneksi, "SELECT kategoriID, namakategori FROM kategori");
                            while($data = mysqli_fetch_array($query)){
                                echo "<option value='".$data['kategoriID']."'>".$data['namakategori']."</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah Stok" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Jenis Produk</label>
                        <select name="jenis_produk" id="jenis_produk" class="form-control" required>
                            <option value="">Pilih Jenis</option>
                            <option value="Bella Square">Bella Square</option>
                            <option value="Pashmina">Pashmina</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Warna Produk</label>
                        <select name="warna_produk" id="warna_produk" class="form-control" required>
                            <option value="">Pilih Warna</option>
                            <option value="Abu-Abu">Abu-Abu</option>
                            <option value="Hitam">Hitam</option>
                            <option value="Merah">Merah</option>
                            <option value="Putih">Putih</option>
                            <option value="Kuning">Kuning</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Deskripsi Pproduk</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" style="width: 100%; height: 80px;" placeholder="Masukkan Deskripsi Produk" required></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <input type="submit" class="btn btn-primary btn-sm" name="btnSimpan" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>