<?php

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "toko_online";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
function CloseCon($conn)
{
    $conn -> close();
}
$conn = OpenCon();

$sql = "SELECT * FROM `proses_jual` WHERE ID_TRANSAKSI =".$_GET['id'];
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
    <h1 align=center>Rincian Pembelian</h1>
    <h2 align="center"><?php
        echo "ID Transaksi : ";
        echo $_GET['id'];
    ?></h2>
    <tr bgcolor = #f5f5dc>
<!--        <td>ID Transaksi</td>-->
        <td>ID Produk</td>
        <td>Nama Produk</td>
        <td>Harga Produk</td>
        <td>Jumlah Beli</td>
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
            $nama = $row["ID_PRODUK"];
            $sql2 = "SELECT NAMA_PRODUK FROM barang WHERE ID_PRODUK = $nama";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            echo $row2["NAMA_PRODUK"];
            ?></td>
        <td><?php
            echo $row["HARGA_PRODUK"];
            ?></td>
        <td><?php
            echo $row["JUMLAH_PRODUK"];
            ?></td>
    </tr>
    <?php
    }
    }
    ?>
    <!-- <td align="center"><a href ="viewcart.php">VIEW CART</a></td>
    <td align="center"><a href="form.php">Add data</a></td> -->
</table>
<center>
    <a href="template_admin.php?content=<?php echo 'penjualan.php'?>">Kembali</a>
</center>
</body>
<?php
$conn->close();
?>
</html>