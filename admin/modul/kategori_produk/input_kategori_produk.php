<?php
if(isset($_POST['btnSimpan'])){
    $nama_kategori = $_POST['nama_kategori'];
    $deskripsi = $_POST['deskripsi'];

    $insert = mysqli_query($koneksi, "INSERT INTO kategori (namakategori,deskripsikategori) VALUES ('$nama_kategori','$deskripsi')");
    if($insert){
        echo "<script>window.location.href='?pages=input_kategori_produk&add_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=input_kategori_produk&add_stat=0'</script>";
    }
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Input Kategori Produk</h6>
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
            <form action="" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" style="width: 100%; height: 80px;" required></textarea>
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