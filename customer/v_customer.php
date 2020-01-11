<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Customer</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama </th>
                            <th class="text-center">Email</th>
                            <th class="text-center">No. Telp</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Kode POS</th>
                            <!-- <th class="text-center">Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT userID, nama, no_telepon, alamat, kode_pos, email FROM user WHERE user.level='User'");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['nama']; ?></td>
                            <td><?php echo $i['email']; ?></td>
                            <td><?php echo $i['no_telepon']; ?></td>
                            <td><?php echo $i['alamat']; ?></td>
                            <td><?php echo $i['kode_pos']; ?></td>
                            <!-- <td class="text-center">
                                <a class="btn btn-sm btn-success" href="?pages=edit_kategori_produk&id=<?php echo $i['kategoriID'] ?>"><i class="icofont-ui-edit"></i></a>
                                <a class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin Untuk Menghapus Data?')" href="?pages=kategori_produk&delete=<?php echo $i['kategoriID'] ?>"><i class="icofont-trash"></i></a>
                            </td> -->
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>