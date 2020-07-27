<?php
session_start();
require('connection.php');
include 'template.php';
   $sql = "SELECT * FROM `barang` WHERE ID_PRODUK =".$_GET['id'];
   $result = $conn->query($sql);
	
   $row = mysqli_fetch_assoc($result);
   $id = $row["ID_PRODUK"];
   $namabarang = $row["NAMA_PRODUK"];
   $hargabarang = $row["HARGA_BARANG"];
   $foto = $row['FILE_FOTO'];
   $stok = $row['STOK_PRODUK'];
   $berat = $row['BERAT_BARANG'];
   echo '<center>';
   echo '<form action="addtocart.php"  method="post">';
   echo"Kode Barang : $id<br>";
   echo"Nama Barang: $namabarang<br>";
   echo"Harga Barang: $hargabarang<br>";
   echo"Berat Barang: $berat kg<br>";
   echo"Stok tersedia: $stok<br>";
   echo'Foto Barang:<br> <img src="images/'.$foto.'" width="250" height="250"><br>';
   echo "Jumlah Pesanan: <input type='number' min='1' name='jumlah_barang' value= 1>";
   echo "<input type='hidden' name='id' value= '$id'<br>"; 
   echo "<input type='hidden' name='stok' value= '$stok'<br>"; 
   echo "<input type='hidden' name='berat' value= '$berat'<br>"; 
   echo "<input type='hidden' name='idpembeli' value= '$id'<br>";
   echo "<input type='hidden' name='nama' value= '$namabarang'<br>";
   echo "<input type='hidden' name='harga' value= '$hargabarang'<br>";
   echo '<input type="submit" value="Submit"><br>';
$conn->close();
?>

<html>
<a href="data_barang.php">BACK</a>
</html>
