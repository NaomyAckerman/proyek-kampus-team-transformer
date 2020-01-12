<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM produk WHERE produkID='$id'");
    if($delete){
        echo "<script>window.location.href='?pages=produk&delete_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=produk&delete_stat=0'</script>";
    }
}

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Produk</h6>
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
            <a href="?pages=input_produk" class="btn btn-sm btn-primary mb-3 float-right">Tambah Produk</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Best Seller</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT produkID, namaproduk, deskripsiproduk, harga, jumlah, GambarProduk, jenisproduk, warnaproduk, kategori.namakategori, best_seller_status FROM `produk` JOIN kategori ON kategori.kategoriID = produk.kategoriID");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['namaproduk']; ?></td>
                            <td><?php echo $i['harga']; ?></td>
                            <td><?php echo $i['jumlah'] ?></td>
                            <td><?php echo $i['namakategori'] ?></td>
                            <td class="text-center">
                                <?php
                                    if($i['best_seller_status'] == '1'){
                                        echo "<span class='badge badge-pill badge-primary'>Tampil</span>";
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-warning" href="?pages=detail_produk&id=<?php echo $i['produkID'] ?>"><i class="icofont-eye"></i></a>
                                <a class="btn btn-sm btn-success" href="?pages=edit_produk&id=<?php echo $i['produkID'] ?>"><i class="icofont-ui-edit"></i></a>
                                <a class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Untuk Menghapus Data?')" href="?pages=produk&delete=<?php echo $i['produkID'] ?>"><i class="icofont-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>