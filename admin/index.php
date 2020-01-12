<?php
session_start();
include 'config/koneksi.php';
if(!isset($_SESSION['userID'])){
  header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ave Hijup</title>

  <!-- Custom fonts for this template -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/font/font.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Icofont -->
  <link rel="stylesheet" href="assets/vendor/icofont/icofont.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?pages=dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="icofont-grocery"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Ave Hijup</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item active">
        <a class="nav-link" href="?pages=dashboard">
          <i class="icofont-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pages=akun">
          <i class="icofont-support"></i>
          <span>Akun Admin</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pages=customer">
          <i class="icofont-users-alt-3"></i>
          <span>Customer</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pages=kategori_produk">
          <i class="icofont-bag"></i>
          <span>Kategori Produk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pages=produk">
          <i class="icofont-grocery"></i>
          <span>Produk</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pages=testimoni">
          <i class="icofont-heart-eyes"></i>
          <span>Testimoni</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pages=transaksi">
          <i class="icofont-ui-note"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                <i class="icofont-user-alt-3" style="font-size:30px;"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="?pages=profil">
                  <i class="icofont-id fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <?php
        if (isset($_GET['pages'])) {
          if($_GET['pages']=='dashboard'){
            include 'modul/dashboard/v_dashboard.php';
          } else if($_GET['pages'] == 'profil'){
            include 'modul/profil/v_profil.php';
          } else if ($_GET['pages'] == 'akun') { //Akun
            include 'modul/akun/v_akun.php';
          } else if($_GET['pages'] == 'customer'){ //Customer
            include 'modul/customer/v_customer.php';
          } else if ($_GET['pages'] == 'input_akun') { //Input kategori produk
            include 'modul/akun/input_akun.php';
          } else if ($_GET['pages'] == 'operasi_akun') { //Edit Kategori Produk
            include 'modul/akun/operasi_akun.php';
          } else if ($_GET['pages'] == 'kategori_produk') { //Kategori Produk
            include 'modul/kategori_produk/v_kategori_produk.php';
          } else if ($_GET['pages'] == 'input_kategori_produk') { //Input kategori produk
            include 'modul/kategori_produk/input_kategori_produk.php';
          } else if ($_GET['pages'] == 'edit_kategori_produk') { //Edit Kategori Produk
            include 'modul/kategori_produk/edit_kategori_produk.php';
          } else if ($_GET['pages'] == 'produk') { //Produk
            include 'modul/produk/v_produk.php';
          } else if ($_GET['pages'] == 'input_produk') { //Input produk
            include 'modul/produk/input_produk.php';
          } else if ($_GET['pages'] == 'edit_produk') { //Edit Produk
            include 'modul/produk/edit_produk.php';
          } else if($_GET['pages'] == 'detail_produk'){ //Detail Produk
            include 'modul/produk/detail_produk.php';
          }else if ($_GET['pages'] == 'testimoni') { //Testimoni
            include 'modul/testimoni/v_testimoni.php';
          } else if ($_GET['pages'] == 'operasi_testimoni') { //Operasi Testimoni
            include 'modul/testimoni/operasi_testimoni.php';
          } else if ($_GET['pages'] == 'transaksi') { //Halaman Transaki
            include 'modul/transaksi/v_transaksi.php';
          }else if ($_GET['pages'] == 'detail_transaksi'){
            include 'modul/transaksi/v_detail_transaksi.php';
          }else if($_GET['pages'] == 'update_transaksi'){
            include 'modul/transaksi/update_transaksi.php';
          }
        } else {
          // include 'pages/dashboard/dashboard-view.php';
        }
        ?>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Ave Hijup 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Untuk Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Untuk Mengakses Sistem Kembali, Anda Diharuskan Melakukan Login Ulang</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>

</body>
      
</html>