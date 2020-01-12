<?php
if(isset($_GET['operation']) && isset($_GET['userID'])){
    $operation = $_GET['operation'];
    $userID = $_GET['userID'];

    $update = mysqli_query($koneksi, "UPDATE user SET user_status='$operation' WHERE userID='$userID'");
    if($update){
        echo "<script>window.location.href='?pages=akun&operation_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=akun&operation_stat=0'</script>";
        
    }
}