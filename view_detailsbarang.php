<?php
session_start();
// $id = $_SESSION['id'];

	function OpenCon()
		 {
			 $dbhost = "localhost";
			 $dbuser = "root";
			 $dbpass = "";
			 $db = "mahasiswa";
			 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
			return $conn;
		 }
		function CloseCon($conn)
		 {
			$conn -> close();
		 }
   $conn = OpenCon();
  
   $sql = "SELECT * FROM `data_barang` WHERE id =".$_GET['id'];
   $result = $conn->query($sql);
	
   $row = mysqli_fetch_assoc($result);
   $id = $row["id"];
   $namabarang = $row["nama"];
   $hargabarang = $row["harga"];
   $foto = $row['namafilefoto'];
   echo '<center><br><br><br><br><br><br>';
   echo '<form action="addtocart.php"  method="post">';
   echo"Kode Barang : $id<br>";
   echo"Nama Barang: $namabarang<br>";
   echo"Harga Barang: $hargabarang<br>";
   echo'Foto Barang:<br> <img src="foto/'.$foto.'" width="250" height="250"><br>';
   echo 'Jumlah Pesanan: <input type="number" min="1" name="jumlahbarang">';
   echo "<input type='hidden' name='id' value= '$id'<br>"; 
   echo "<input type='hidden' name='idpembeli' value= '$id'<br>";
   echo "<input type='hidden' name='nama' value= '$namabarang'<br>";
   echo "<input type='hidden' name='harga' value= '$hargabarang'<br>";
   echo "<input type='hidden' name='idpembeli' value= '$id'<br>";
   echo '<input type="submit" value="Submit"><br>';
?>

<html>
<a href="template.php?content=<?php echo 'data_barang.php'?>">BACK</a>
</html>
