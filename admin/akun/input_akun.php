<?php
if(isset($_POST['btnSimpan'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi,$_POST['password']);
    $repassword = mysqli_real_escape_string($koneksi, $_POST['repassword']);
    
    if($password == $repassword){
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $insert = mysqli_query($koneksi, "INSERT INTO user (nama , email , user.password, user.level, user_status) 
        VALUES ('$nama','$email','$password_hashed', 'Admin', '1')");
        if($insert){
            echo "<script>window.location.href='?pages=input_akun&add_stat=1'</script>";
        }else{
            echo "<script>window.location.href='?pages=input_akun&add_stat=0'</script>";
        }
    }else{
        echo "<script>window.location.href='?pages=input_akun&add_stat=0&message=Password Tidak Sama, Silahkan Ulangi'</script>";
    }
    
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Input Akun</h6>
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
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Repassword</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" required>
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