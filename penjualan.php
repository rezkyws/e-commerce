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
$sql = "SELECT * FROM penjualan";
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
        <td>ID Transaksi</td>
        <td>Tgl transaksi</td>
        <td>Nama Pembeli</td>
        <td>No. Hp</td>
        <td>Alamat</td>
        <td>Kode Pos</td>
        <td>Total Pembayaran</td>
        <td>Status Penjualan</td>
        <td>Action</td>
        <td>Detail Penjualan</td>
    </tr>
    <tr>
        <?php
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
        ?>
        <td><?php
            echo $row["ID_TRANSAKSI"];
            ?></td>
        <td><?php
            echo $row["TGL_TRANSAKSI"];
            ?></td>
        <td><?php
            echo $row["NAMA_PEMBELI"];
            ?></td>
        <td><?php
            echo $row["NO_HP"];
            ?></td>
        <td><?php
            echo $row["ALAMAT"];
            ?></td>
        <td><?php
            echo $row["KODE_POS"];
            ?></td>
        <td><?php
            echo $row["TOTAL_PEMBAYARAN"];
            ?></td>
        <td><?php
            $status = $row["STATUS_PENJUALAN"];
            if ($status == '0'){
                echo "Belum Dibayar";
            } else if ($status == '1'){
                echo "Sudah Bayar";
            } else {
                echo "Sudah dikirim";
            }
            ?></td>
        <td><?php
            $status = $row["STATUS_PENJUALAN"];?>
            <?php  if ($status == '0'){ ?>
                <a href="update_status.php?id=<?php echo $row['ID_TRANSAKSI']?>">Sudah dibayar </a><br>
            <?php } ?>
            <?php if($status == '1'){ ?>
                <a href="update_status.php?id=<?php echo $row['ID_TRANSAKSI']?>">Sudah dikirim </a><br>
            <?php } ?>
            <?php if($status == '2'){ ?>
                <a>Transaksi Selesai </a><br>
            <?php } ?></td>
        <td><a href="detail_pembelian.php?id=<?php echo $row['ID_TRANSAKSI']?>">Detail Pembelian</a></td>
    </tr>
    <?php
        }
    }
    ?>
    <!-- <td align="center"><a href ="viewcart.php">VIEW CART</a></td>
    <td align="center"><a href="form.php">Add data</a></td> -->
</table>
</body>
<?php
$conn->close();
?>
</html>