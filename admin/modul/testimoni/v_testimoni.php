<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Testimoni</h6>
        </div>
        <div class="card-body">
        <?php
            if(isset($_GET['operation_stat'])){
                if($_GET['operation_stat']==1){
                    echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Operasi Berhasil!!</div>";
                }else if($_GET['operation_stat']==0){
                    if(isset($_GET['message'])){
                        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$_GET['message']."</div>";
                    }else{
                        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Operasi Gagal!!</div>";
                    }
                }
            }
        ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Gambar</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT testimoniID, Gambartesti, Keterangan, user.userID, user.nama, produk.produkID, produk.namaproduk, testimoni.show_status FROM testimoni LEFT JOIN user ON testimoni.userID=user.userID LEFT JOIN produk ON testimoni.produkID = produk.produkID");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['nama']; ?></td>
                            <td><?php echo $i['namaproduk']; ?></td>
                            <td><?php echo $i['Gambartesti']; ?></td>
                            <td><?php echo $i['Keterangan']; ?></td>
                            <td class="text-center">
                            <?php
                                if($i['show_status'] == "1"){
                                    echo "<span class='badge badge-pill badge-primary'>Tampil</span>";
                                } else if($i['show_status'] == "0"){
                                    echo "<span class='badge badge-pill badge-danger'>Tidak Tampil</span>";
                                }
                            ?>
                            </td>
                            <td class="text-center">
                                <?php if($i['show_status'] == "1"){ ?>
                                <a href="?pages=operasi_testimoni&operation=0&userID=<?php echo $i['userID'] ?>" class="btn btn-sm btn-danger"><i class="icofont-eye"></i></a>
                                <?php }else if($i['show_status'] == "0"){ ?>
                                <a href="?pages=operasi_testimoni&operation=1&userID=<?php echo $i['userID'] ?>" class="btn btn-sm btn-primary"><i class="icofont-eye"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>