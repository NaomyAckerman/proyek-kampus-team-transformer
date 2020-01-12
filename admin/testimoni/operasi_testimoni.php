<?php
if(isset($_GET['operation']) && isset($_GET['userID'])){
    $operation = $_GET['operation'];
    $userID = $_GET['userID'];

    $update = mysqli_query($koneksi, "UPDATE testimoni SET show_status='$operation' WHERE userID='$userID'");
    if($update){
        echo "<script>window.location.href='?pages=testimoni&operation_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=testimoni&operation_stat=0'</script>";
        
    }
}