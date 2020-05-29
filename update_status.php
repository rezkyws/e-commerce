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

$sql = "SELECT * FROM `penjualan` WHERE ID_TRANSAKSI =".$_GET['id'];
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$status = $row["STATUS_PENJUALAN"];

if ($status == 0) {
    $sql2 = "UPDATE penjualan SET STATUS_PENJUALAN = 1 WHERE ID_TRANSAKSI =".$_GET['id'];
    if ($conn->query($sql2) === TRUE) {
        echo "update status sukses!";
        header("location:template_admin.php?content=penjualan.php");
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
} else if ($status == 1) {
    $sql3 = "UPDATE penjualan SET STATUS_PENJUALAN = 2 WHERE ID_TRANSAKSI =".$_GET['id'];
    if ($conn->query($sql3) === TRUE) {
        echo "update status sukses!";
        header("location:template_admin.php?content=penjualan.php");
    } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
CloseCon($conn);

//$row = mysqli_fetch_assoc($result);
//$id = $row["id"];
//$nama = $row["nama"];
//$harga = $row["harga"];
//$namafilefoto = $row["namafilefoto"];
?>
