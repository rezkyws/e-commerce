<?php
session_start();
$i = $_GET['id'];
echo $i;
//while (isset($_SESSION['id'][$i]))
//{
//    $i = $i +1;
//}
//$_SESSION['id'][$i] = $_POST['id'];
//$_SESSION['idpembeli'][$i] = $_POST['idpembeli'];
//$_SESSION['namabarang'][$i] = $_POST['nama'];
//$_SESSION['hargabarang'][$i] = $_POST['harga'];
$_SESSION['jumlah_barang'][$i] = $_POST['jumlah_barang'];
//$_SESSION['berat'][$i] = $_POST['berat'];
header("location:ViewCart.php");

?>

<!--<html>-->
<!--<body>-->
<!--"<script>alert('Berhasil ditambahkan kedalam keranjang!');document.location="ViewCart.php"</script>";-->
<!--</body>-->
<!--</html>-->
