<?php
if(isset($_POST['btnSimpan'])){
    $transaksiID = mysqli_real_escape_string($koneksi, $_POST['transaksiID']);
    $status_pembayaran = mysqli_real_escape_string($koneksi, $_POST['status_pembayaran']);
    $kurir = mysqli_real_escape_string($koneksi, $_POST['kurir']);
    $no_resi = mysqli_real_escape_string($koneksi, $_POST['no_resi']);
    $status_pengiriman = mysqli_real_escape_string($koneksi, $_POST['status_pengiriman']);

    $update = mysqli_query($koneksi, "UPDATE transaksi SET status_pembayaran='$status_pembayaran', kurir_pengiriman='$kurir', no_resi='$no_resi', status_pengiriman='$status_pengiriman' WHERE transaksiID='$transaksiID'");
    if($update){
        echo "<script>window.location.href='?pages=update_transaksi&transaksiID=".$transaksiID."&edit_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=update_transaksi&transaksiID=".$transaksiID."&edit_stat=0'</script>";
    }
}
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Update Transaksi</h6>
        </div>
        <div class="card-body">
        <?php
            if(isset($_GET['edit_stat'])){
                if($_GET['edit_stat']==1){
                    echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Transaksi Berhasil Diubah!!</div>";
                }else if($_GET['edit_stat']==0){
                    echo "<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Transaksi Gagal Diubah!!</div>";
                }
            }
        ?>
            <form action="" method="post">
                <?php 
                if(isset($_GET['transaksiID'])){  
                    $transaksiID = $_GET['transaksiID'];   
                    $query = mysqli_query($koneksi, "SELECT status_pembayaran, kurir_pengiriman ,no_resi, status_pengiriman  FROM transaksi WHERE transaksiID='$transaksiID'");
                    $data = mysqli_fetch_array($query); 
                ?>
                <div class="row">
                    <input type="hidden" name="transaksiID" value="<?php echo $transaksiID; ?>">
                    <div class="form-group col-md-4">
                        <label for="">Invoices</label>
                        <input type="text" class="form-control" value="<?php echo $transaksiID; ?>" readonly required>
                    </div>
                    
                </div>
                <div class="row">
                    
                    <div class="form-group col-md-4">
                        <label for="">Status Pembayaran</label>
                        <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                            <option value="0" <?php if($data['status_pembayaran'] == 0){echo "Selected";} ?>>Belum Dibayar</option>
                            <option value="1" <?php if($data['status_pembayaran'] == 1){echo "Selected";} ?>>Terbayar</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Kurir Pengiriman</label>
                        <select name="kurir" id="kurir" class="form-control">
                            <option value="" <?php if($data['kurir_pengiriman'] == ""){echo "Selected";} ?>>Pilih</option>
                            <option value="JNE" <?php if($data['kurir_pengiriman'] == "JNE"){echo "Selected";} ?>>JNE</option>
                            <option value="TIKI" <?php if($data['kurir_pengiriman'] == "TIKI"){echo "Selected";} ?>>TIKI</option>
                            <option value="J&T" <?php if($data['kurir_pengiriman'] == "J&T"){echo "Selected";} ?>>J&T</option>
                            <option value="POS" <?php if($data['kurir_pengiriman'] == "POS"){echo "Selected";} ?>>POS</option>
                            <option value="SiCepat" <?php if($data['kurir_pengiriman'] == "SiCepat"){echo "Selected";} ?>>SiCepat</option>
                            <option value="Wahana" <?php if($data['kurir_pengiriman'] == "Wahana"){echo "Selected";} ?>>Wahana</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="">No Resi</label>
                        <input type="text" class="form-control" name="no_resi" id="no_resi" value="<?php echo $data['no_resi'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Status Pengiriman</label>
                        <select name="status_pengiriman" id="status_pengiriman" class="form-control" required>
                            <option value="0" <?php if($data['status_pengiriman'] == 0){echo "Selected";} ?>>Belum Dikirim</option>
                            <option value="1" <?php if($data['status_pengiriman'] == 1){echo "Selected";} ?>>Terkirim</option>
                        </select>
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