<html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "toko_online";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
?>
<style>
</style>
<head>
    <title>Title</title>
</head>
<body>
<!-- <h1><a href="logout.php">Logout</a></h2> -->
<table border= "1", align = "center">
    <tr bgcolor = #f5f5dc>
        <td>id</td>
        <td>Nama</td>
        <td>Harga</td>
        <td>Stok</td>
        <td>Berat</td>
        <td>FOTO</td>
        <td>Action</td>
     
    </tr>
    <tr>
        <?php
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
        ?>
        <td><?php
            echo $row["ID_PRODUK"];
            ?></td>
        <td><?php
            echo $row["NAMA_PRODUK"];
            ?></td>
        <td><?php
            echo $row["HARGA_BARANG"];
            ?></td>
        <td><?php
            echo $row["STOK_PRODUK"];
            ?></td>
        <td><?php
            echo $row["BERAT_BARANG"];
            echo ' kg';
            ?></td>
        <td><img src = "./images/<?php echo $row['FILE_FOTO'] ;?>" style = "width: 80px"></td>
        <td><a href="update_barang.php?id=<?php echo $row['ID_PRODUK']?>">Update </a><br>
            <a href="view_detailsbarang.php?id=<?php echo $row['ID_PRODUK']?>">Beli</a></td>
    </tr>
    <?php
        }
    }
    ?>
    <td align="center"><a href="template.php?content=<?php echo 'ViewCart.php'?>">View Cart</a></td>
    <td align="center"><a href="tambah_barang.php">Add data</a></td>
</table>
</body>
<?php
$conn->close();
?>
</html>