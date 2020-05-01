<?php
if(isset($_GET['operation']) && isset($_GET['ID'])){
    $operation = $_GET['operation'];
    $ID = $_GET['ID'];

    $update = mysqli_query($koneksi, "UPDATE testimoni SET show_status='$operation' WHERE testimoniID='$ID'");
    if($update){
        echo "<script>window.location.href='?pages=testimoni&operation_stat=1'</script>";
    }else{
        echo "<script>window.location.href='?pages=testimoni&operation_stat=0'</script>";
        
    }
}