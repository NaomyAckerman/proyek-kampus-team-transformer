<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Akun Admin</h6>
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
            <a href="?pages=input_akun" class="btn btn-sm btn-primary mb-3 float-right">Tambah Akun</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE user.level='Admin'");
                        while($i = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><?php echo $no++.'.'; ?></td>
                            <td><?php echo $i['nama']; ?></td>
                            <td><?php echo $i['email']; ?></td>
                            <td class="text-center">
                                <?php if($i['user_status'] == "1"){ ?>
                                <a href="?pages=operasi_akun&operation=0&userID=<?php echo $i['userID'] ?>" class="btn btn-sm btn-danger"><i class="icofont-ui-password"></i></a>
                                <?php }else if($i['user_status'] == "0"){ ?>
                                <a href="?pages=operasi_akun&operation=1&userID=<?php echo $i['userID'] ?>" class="btn btn-sm btn-primary"><i class="icofont-ui-password"></i></a>
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