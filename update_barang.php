<?php

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
$nama = $row["nama"];
$harga = $row["harga"];
$namafilefoto = $row["namafilefoto"];
?>
<html lang="en">
<style>
    form {
        margin: 0 auto;
        width:250px;
    }
    h2 {
        text-align: center;
    }
</style>
<body>

<h2>Update Barang</h2>
<form action="update.php"  method="post" enctype="multipart/form-data">
    <label for="id">ID: <?php echo $id;?></label><br>
    <input type="hidden" id="id" name="id" value=<?php echo $id;?>><br>
    <label for="nama">NAMA:</label><br>
    <input type="text" id="nama" name="nama" value=<?php echo $nama;?>><br><br>
    <label for="gambar">Gambar: <br><img src="foto/<?php echo $namafilefoto;?>" width='150' height='150'></label><br>
    <input type="file" id="gambar" name="gambar"><br>
    <label for="deskripsi">Harga:</label><br>
    <input type="number" id="harga" name="harga" value=<?php echo $harga;?>><br><br>
    <input type="hidden" id= "foto_lama" name="foto_lama" value=<?php echo $namafilefoto;?>>
    <input type="submit" value="Submit">
</form>
</body>
</html>

</body>
</html>