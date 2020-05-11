<html>
<body>
<style>
table,td,th{
  border: 1;
  font-size: 20;
}

</style>
<table style="whargabarangbarangth:30%" align="left"; border=1;>
	<tr>
	<th>Kode</th>
	<th>Barang</th>
	<th>Foto</th>
	<th>Harga</th>
	<th>Jumlah</th>
	<th>Subtotal</th>
	<th>Delete</th>
	</tr>
	<br>
	<?php
	session_start();
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
		$total = 0; 
		$conn = OpenCon();
		$n = 1;
		while (isset($_SESSION['id'][$n]))
		{
			$id = $_SESSION['id'][$n];
			$jumlahbarang = $_SESSION['jumlahbarang'][$n];
			
			$sql2 = "SELECT * FROM `data_barang` where`id` = $id";
			$result2 = $conn->query($sql2);
			while($row2 = $result2->fetch_assoc())
			{
				$nama = $row2["nama"];
				$harga = $row2["harga"];
				$foto = $row2['namafilefoto'];
			}
			$subtotal = $harga*$jumlahbarang;
			$total = $total + $subtotal;
			echo"<tr>";
			echo"<td>$id</td>";
			echo"<td>$nama</td>";
			echo "<td>";?><img src="foto/<?php echo $foto;?>" width='100' height='100'><?php echo "</td>";
			echo"<td>Rp.$harga</td>";
			echo "<td>$jumlahbarang</td>";
			echo"<td>Rp.$subtotal</td>";
			echo "<td><a href='view_deletecart.php?id=".$n."'>Delete</td>";
			echo"</tr>";
			
			$n = $n +1;
		}
		echo '<td colspan="7">Total Harga= Rp.';echo $total;echo'</td>';
		
		CloseCon($conn);
	?>	
</table>
</body>
<left>
<a href="template.php?content=<?php echo 'data_barang.php'?>">Tambah Barang</a>
</left>
</html>