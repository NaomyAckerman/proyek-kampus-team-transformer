<?php
if(isset($_POST['btnSimpan'])){
    $id = $_POST['id'];
    $nama_kategori = $_POST['nama_kategori'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($koneksi, "UPDATE kategori set namakategori='$nama_kategori', deskripsikategori='$deskripsi' WHERE kategoriID='$id'");
    if($update){
        echo "<script>window.location.href='?pages=edit_kategori_produk&edit_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=edit_kategori_produk&edit_stat=0'</script>";
    }
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategoriID='$id'");
    $data = mysqli_fetch_array($query);
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Kategori Produk</h6>
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
            <form action="" method="post">
                <?php if(isset($_GET['id'])){ ?>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group col-md-4">
                        <label for="">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?php echo $data['namakategori'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" style="width: 100%; height: 80px;" required><?php echo $data['deskripsikategori'] ?></textarea>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="form-group col-md-2">
                        <input type="submit" class="btn btn-primary btn-sm" name="btnSimpan" value="Simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>