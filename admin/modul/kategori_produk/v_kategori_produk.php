<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE kategoriID='$id'");
    if($delete){
        echo "<script>window.location.href='?pages=kategori_produk&delete_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=kategori_produk&delete_stat=0'</script>";
    }
}

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Kategori Produk</h6>
        </div>
        <div class="card-body">
        <?php
            if(isset($_GET['delete_stat'])){
                if($_GET['delete_stat']==1){
                    echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Berhasil Dihapus!!</div>";
                }else if($_GET['delete_stat']==0){
                    echo "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Gagal Dihapus!!</div>";
                }
            }
        ?>
            <a href="?pages=input_kategori_produk" class="btn btn-sm btn-primary mb-3 float-right">Tambah Kategori</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Kategori</th>
                            <th class="text-center">Desc</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['namakategori']; ?></td>
                            <td><?php echo $i['deskripsikategori']; ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success" href="?pages=edit_kategori_produk&id=<?php echo $i['kategoriID'] ?>"><i class="icofont-ui-edit"></i></a>
                                <a class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Untuk Menghapus Data?')" href="?pages=kategori_produk&delete=<?php echo $i['kategoriID'] ?>"><i class="icofont-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>