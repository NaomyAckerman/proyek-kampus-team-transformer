<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Detail Produk</h6>
        </div>
        <div class="card-body">
            <?php
            $query = mysqli_query($koneksi, "SELECT produkID, namaproduk, deskripsiproduk, harga, jumlah, GambarProduk, jenisproduk, warnaproduk, 
            best_seller_status, kategori.namakategori,kategori.deskripsikategori FROM produk JOIN kategori ON produk.kategoriID = kategori.kategoriID 
            WHERE produkID='$_GET[id]'");
            while($val = mysqli_fetch_array($query)){
            ?>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Kategori</label>
                    <input type="text" class="form- form-control-plaintext" value="<?php echo $val['namakategori']; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Nama Produk</label>
                    <input type="text" class="form- form-control-plaintext" value="<?php echo $val['namaproduk']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Harga</label>
                    <input type="text" class="form- form-control-plaintext" value="<?php echo $val['harga']; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Jumlah Stok</label>
                    <input type="text" class="form- form-control-plaintext" value="<?php echo $val['jumlah']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Jenis Produk</label>
                    <input type="text" class="form- form-control-plaintext" value="<?php echo $val['jenisproduk']; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Warna Produk</label>
                    <input type="text" class="form- form-control-plaintext" value="<?php echo $val['warnaproduk']; ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Deskripsi Pproduk</label>
                    <textarea name="deskripsi" class="form-control-plaintext" id="deskripsi" style="width: 100%; height: 80px;" placeholder="Masukkan Deskripsi Produk" required><?php echo $val['deskripsiproduk']; ?></textarea>
                </div>
                <div class="form-group col-md-4">
                    <label for="" class="font-weight-bold">Gambar</label><br>
                    <a class="btn btn-sm btn-primary" href="uploaded_files/<?php echo $val['GambarProduk']; ?>" target="_blank">Link Gambar</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>