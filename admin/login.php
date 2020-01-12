<?php
session_start();
include 'config/koneksi.php';
if (isset($_SESSION['userID'])) {
  header("location: index.php");
}

if (isset($_POST['btnLogin'])) {
  $email = mysqli_real_escape_string($koneksi, $_POST['email']);
  $password = mysqli_real_escape_string($koneksi, $_POST['password']);

  $query = mysqli_query($koneksi, "SELECT userID, nama, user.level, user.password, user.user_status FROM user WHERE email='$email'");
  if(mysqli_num_rows($query) == 1){
    // echo "<script>alert('Data Ada')</script>";
    while($data = mysqli_fetch_array($query)){
      if(password_verify($password,$data['password']) && $data['level'] == "Admin" && $data['user_status'] == "1"){
        // echo "<script>alert('Password Sama')</script>";
        $_SESSION['userID'] = $data['userID'];
        $_SESSION['nama'] = $data['nama'];
        header("location: index.php");
      }else {
        header("location: login.php?message=error");    
      }
    }

  }else{
    header("location: login.php?message=error");
  }


  
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

  <title>Ave Hijup - Login</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/font/font.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <?php 
                  if(isset($_GET['message'])){
                    echo "<div class='alert alert-danger'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Username / Password Salah</div>";
                  }
                  ?>
                  <form class="user" method="POST" action="">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputUsername" name="email" placeholder="Masukkan Email" required="">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Masukkan Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="btnLogin">Login</button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
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

</body>

</html>