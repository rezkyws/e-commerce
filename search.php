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
	<td>NIM</td>
    <td>NAMA</td>
    <td>UMUR</td>
	<td>SEX</td>
	<td>FOTO</td>
</tr>
<?php
if(!ISSET($_POST['submit'])){

$sql = "SELECT * FROM data_diri_mahasiswa";
$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($query)){

?>
<tr>
<td><?php echo $row['nim']; ?></td>
 <td><?php echo $row['nama']; ?></td>
 <td><?php echo $row['umur']; ?></td>
 <td><?php echo $row['sex']; ?></td>
 <td><img src = "./foto/<?php echo $row['namafilefoto'] ;?>" style = "width: 80px"></td>
</tr>

<?php } } ?>

<?php if (ISSET($_POST['submit'])){
 $cari = $_POST['nt'];
 $query2 = "SELECT * FROM data_diri_mahasiswa WHERE nama LIKE '%$cari%'";
 
 $sql = mysqli_query($conn, $query2);
 while ($r = mysqli_fetch_array($sql)){
  ?>
<tr>
<td><?php echo $r['nim']; ?></td>
 <td><?php echo $r['nama']; ?></td>
 <td><?php echo $r['umur']; ?></td>
 <td><?php echo $r['sex']; ?></td>
 <td><<img src ='./foto/<?php echo $r['namafilefoto']; ?>' width='80px'></td>
</tr>  
 <?php }} ?>

</table>