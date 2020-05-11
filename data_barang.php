<html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahasiswa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM data_barang";
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
            echo $row["id"];
            ?></td>
        <td><?php
            echo $row["nama"];
            ?></td>
        <td><?php
            echo $row["harga"];
            ?></td>
        <td><img src = "./foto/<?php echo $row['namafilefoto'] ;?>" style = "width: 80px"></td>
        <td><a href="update_barang.php?id=<?php echo $row['id']?>">Update </a><br>
            <a href="view_detailsbarang.php?id=<?php echo $row['id']?>">Beli</a></td>
    </tr>
    <?php
        }
    }
    ?>
    <td align="center"><a href ="viewcart.php">VIEW CART</a></td>
    <td align="center"><a href="form.php">Add data</a></td>
</table>
</body>
<?php
$conn->close();
?>
</html>