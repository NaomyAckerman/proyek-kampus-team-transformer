<?php
if(isset($_POST['btnSimpan'])){
    $userID = mysqli_real_escape_string($koneksi, $_POST['userID']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password_lama = mysqli_real_escape_string($koneksi, $_POST['password_lama']);
    $password_baru = mysqli_real_escape_string($koneksi,$_POST['password_baru']);
    $repassword = mysqli_real_escape_string($koneksi, $_POST['repassword']);

    if($password_lama == "" && $password_baru == "" && $repassword == ""){ //Update Nama dan Email tanpa merubah password
        $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email' WHERE user.userID='$userID'");

        if($update){
            echo "<script>window.location.href='?pages=profil&edit_stat=1'</script>";
        }else{
            echo "<script>window.location.href='?pages=profil&edit_stat=0'</script>";
        }

    }else if($password_lama != "" && $password_baru != "" && $repassword != ""){ //Update Nama, Email dan Password
        //Query Untuk mengambil data password dari database
        $query = mysqli_query($koneksi, "SELECT user.password FROM user WHERE user.userID='$userID'"); 
        $data = mysqli_fetch_array($query);

        //Mengecek  Kesamaan Password Lama 
        if(password_verify($password_lama, $data['password'])){
            //Mengecek Kesesuaian Password Baru dan konfirmasi
            if($password_baru == $repassword){ 
                
                $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
                $update = mysqli_query($koneksi,"UPDATE user SET nama='$nama', email='$email', user.password='$hashed_password' WHERE user.userID='$userID'");

                if($update){
                    echo "<script>window.location.href='?pages=profil&edit_stat=1'</script>";
                }else{
                    echo "<script>window.location.href='?pages=profil&edit_stat=0'</script>";
                }
            }else{
                echo "<script>window.location.href='?pages=profil&edit_stat=0&messages=Password Baru dan Konfirmasi Password Baru Tidak Sesuai'</script>";
            }
        }else{
            echo "<script>window.location.href='?pages=profil&edit_stat=0&messages=Password Lama Salah'</script>";
        }
        
    }
    
    
}
if(isset($_SESSION['userID'])){
    $id = $_SESSION['userID'];
    $query = mysqli_query($koneksi, "SELECT nama, email FROM user WHERE userID='$id'");
    $data = mysqli_fetch_array($query);
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Ubah Profil</h6>
        </div>
        <div class="card-body">
        <?php
            if(isset($_GET['edit_stat'])){
                if($_GET['edit_stat']==1){
                    echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Berhasil Diubah!!</div>";
                }else if($_GET['edit_stat']==0){
                    if(isset($_GET['messages'])){
                        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$_GET['messages']."</div>";
                    }else{
                        echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Data Gagal Diubah!!</div>";
                    }
                }
            }
            if(isset($_SESSION['userID'])){
        ?>
            <form action="" method="post">
                <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['userID']; ?>">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama']; ?>" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $data['email'] ?>" placeholder="Masukkan Email" required>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <label style="font-size: 0.8rem;">**Kosongkan Password Jika Tidak Ingin Merubah</label>&nbsp;&nbsp;&nbsp;
                        <label style="font-size: 0.8rem;">**Isi Password Lama, Password Baru, Dan Konfirmasi Password Untuk Melakukan Perubahan Password</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Password Lama</label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukkan Password Lama">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Password Baru</label>
                        <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">Konfirmasi password</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Ulangi Password Baru">
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-2">
                        <input type="submit" class="btn btn-primary btn-sm" name="btnSimpan" value="Simpan">
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>

</div>