<?php 
require_once'koneksi.php';
?>

<form method="post">
<input type="text" name="nt" placeholder="cari ...">
<input type="submit" name="submit" value="cari">
<form>
<br/>
<br/>

<table border=1>
<tr> 
	<td>ID PRODUK</td>
    <td>NAMA PRODUK</td>
    <td>STOK PRODUK</td>
	<td>HARGA BARANG</td>
	<td>BERAT BARANG</td>
    <td>GAMBAR</td>
</tr>
<?php
if(!ISSET($_POST['submit'])){

$sql = "SELECT * FROM barang";
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)){

?>
<tr>
<td><?php echo $row['ID_PRODUK']; ?></td>
 <td><?php echo $row['NAMA_PRODUK']; ?></td>
 <td><?php echo $row['STOK_PRODUK']; ?></td>
 <td><?php echo $row['HARGA_BARANG']; ?></td>
    <td><?php echo $row['BERAT_BARANG']; ?></td>
 <td><img src = "./images/<?php echo $row['FILE_FOTO'] ;?>" style = "width: 80px"></td>
</tr>

<?php } } ?>

<?php if (ISSET($_POST['submit'])){
 $cari = $_POST['nt'];
 $query2 = "SELECT * FROM barang WHERE NAMA_PRODUK LIKE '%$cari%'";
 
 $sql = mysqli_query($conn, $query2);
 while ($r = mysqli_fetch_array($sql)){
  ?>
<tr>
<td><?php echo $r['ID_PRODUK']; ?></td>
 <td><?php echo $r['NAMA_PRODUK']; ?></td>
 <td><?php echo $r['STOK_PRODUK']; ?></td>
 <td><?php echo $r['HARGA_BARANG']; ?></td>
    <td><?php echo $r['BERAT_BARANG']; ?></td>
 <td><<img src ='./images/<?php echo $r['FILE_FOTO']; ?>' width='80px'></td>
</tr>  
 <?php }} ?>

</table>