<?php 
$transaksiID = $_GET['transaksiID'];
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
            <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <?php 
                    $query = mysqli_query($koneksi, "SELECT transaksiID FROM transaksi LEFT JOIN user ON transaksi.userID = user.userID WHERE transaksiID='$transaksiID'");
                    while($i = mysqli_fetch_array($query)){
                ?>
                <a class="dropdown-item" href="?pages=update_transaksi&transaksiID=<?php echo $i['transaksiID'] ?>">Update Transaksi</a>
                <?php } ?>
            </div>
            </div>
        </div>
        <div class="card-body">
            <?php 
                $query = mysqli_query($koneksi, "SELECT transaksiID, user.userID, user.nama, total_pembayaran, tgl_transaksi, transaksi.alamat, transaksi.kode_pos, gbrbukti_pembayaran, status_pembayaran, no_resi, status_pengiriman  FROM transaksi LEFT JOIN user ON transaksi.userID = user.userID WHERE transaksiID='$transaksiID'");
                while($i = mysqli_fetch_array($query)){
            ?>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="" style="font-weight:bold">Tgl. Transaksi</label>
                    <input type="text" class="form-control-plaintext" value="<?php $date=date_create($i['tgl_transaksi']);echo date_format($date,"d-m-Y"); ?>" readonly>
                </div>
                <div class="col-md-4 form-group">
                    <label for="" style="font-weight:bold">Customer</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $i['nama']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">   
                    <label for="" style="font-weight: bold">Kode Pos</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $i['kode_pos']; ?>" readonly>
                </div>
                <div class="col-md-4 form-group">
                    <label for="" style="font-weight:bold">Alamat</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $i['alamat']; ?>" readonly>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="" style="font-weight:bold">Bukti Pembayaran</label><br>
                    <?php
                    if(!empty($i['gbrbukti_pembayaran'])){
                        echo "<a class='btn btn-sm btn-primary' href='uploaded_files/$i[gbrbukti_pembayaran]' target='_blank'>Link Gambar</a>";
                    }
                    ?>
                </div>
                <div class="col-md-4 form-group">
                    <label for="" style="font-weight:bold">Status Pembayaran</label><br>
                    <?php
                    if($i['status_pembayaran'] == "1"){
                        echo "<span class='badge badge-pill badge-primary'>Terbayar</span>";
                    } else if($i['status_pembayaran'] == "0"){
                        echo "<span class='badge badge-pill badge-danger'>Belum Dibayar</span>";
                    }
                    ?>
                </div>
                <div class="col-md-4 form-group">
                    <label for="" style="font-weight:bold">Status Pengiriman</label><br>
                    <?php
                        if($i['status_pengiriman'] == "1"){
                            echo "<span class='badge badge-pill badge-primary'>Terkirim</span>";
                        } else if($i['status_pengiriman'] == "0"){
                            echo "<span class='badge badge-pill badge-danger'>Belum Dikirim</span>";
                        }
                    ?>
                </div>
                <div class="col-md-4 form-group">
                    <label for="" style="font-weight:bold">No. Resi</label>
                    <input type="text" class="form-control-plaintext" value="<?php echo $i['no_resi']; ?>" readonly>
                </div>
                
                
            </div>
            <?php } ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT no_detail, transaksiID, produk.produkID, produk.namaproduk, qty, detail_transaksi.harga, subtotal FROM detail_transaksi JOIN produk ON detail_transaksi.produkID = produk.produkID WHERE detail_transaksi.transaksiID = $transaksiID");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['namaproduk']; ?></td>
                            <td><?php echo $i['qty']; ?></td>
                            <td class="text-right"><?php echo "Rp. ".number_format($i['harga'],0,',','.'); ?></td>
                            <td class="text-right"><?php echo "Rp. ".number_format($i['subtotal'],0,',','.'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>