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
            <h6 class="m-0 font-weight-bold text-primary"> Transaksi</h6>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Tgl. Transaksi</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Total Pembayaran</th>
                            <th class="text-center">Status Pembayaran</th>
                            <th class="text-center">Status Pengiriman</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT transaksiID, user.userID, user.nama, total_pembayaran, tgl_transaksi, transaksi.alamat, transaksi.kode_pos, gbrbukti_pembayaran, 
                        status_pembayaran, status_pengiriman, no_resi FROM transaksi LEFT JOIN user ON transaksi.userID = user.userID");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['tgl_transaksi']; ?></td>
                            <td><?php echo $i['nama']; ?></td>
                            <td class="text-right"><?php echo "Rp. ".number_format($i['total_pembayaran'],0,',','.'); ?></td>
                            <td class="text-center">
                            <?php
                                if($i['status_pembayaran'] == "1"){
                                    echo "<span class='badge badge-pill badge-primary'>Terbayar</span>";
                                } else if($i['status_pembayaran'] == "0"){
                                    echo "<span class='badge badge-pill badge-danger'>Belum Dibayar</span>";
                                }
                            ?>
                            </td>
                            <td class="text-center">
                            <?php
                                if($i['status_pengiriman'] == "1"){
                                    echo "<span class='badge badge-pill badge-primary'>Terkirim</span>";
                                } else if($i['status_pengiriman'] == "0"){
                                    echo "<span class='badge badge-pill badge-danger'>Belum Dikirim</span>";
                                }
                            ?>
                            </td>
                            <td class="text-center">
                                <a href="?pages=detail_transaksi&transaksiID=<?php echo $i['transaksiID'] ?>" class="btn btn-warning btn-sm"><i class="icofont-eye"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>