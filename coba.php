<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script>
function validasi(){
  var coba = document.getElementsById("coba");
  if (coba.value == "") {
    alert("passwword kosong");
    return false;
  }
  else{
    alert("sudah diisi");
    true;
  }
}
  </script>

<script type="text/javascript">
  function validasi2(){
        var nomor_hp=document.forms["formtlp"]["nohp"].value;
        var number=/^[0-9]+$/;
        if (nomor_hp==null || nomor_hp==""){
          alert('lol');
          event.preventDefault();
          event.stopPropagation();
          return false;
        };
          
        if (!nomor_hp.match(number)){
          alert("Nomor Handphone harus angka !");
          return false;
        };
          
        if (nomor_hp.length!=12){
          alert("Nomor Handphone Harus 12 Digit");
          return false;
        };
     }
</script>

</head>
<body>

<form onsubmit="validasi2()" id="formtlp" action="daftarmasuk.php" method="POST">
    Nomor Handphone :
    <input type="text" name="nohp" id="nohp"/>
    <input type="submit" value="Cek">
</form>

<form onsubmit="return validasi()" action="" method="POST">
      <input type="text" id="coba">
      <button  type="submit" name="coba">submit</button>
</form>
</body>
</html>
<?php 
if (isset($_POST['coba'])) {
  echo "<script>
      Swal.fire('Any fool can use a computer');
  </script>"; die();
}
 ?>