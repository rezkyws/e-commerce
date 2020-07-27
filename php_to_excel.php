<html>
<?php
require('connection.php');
$sql = "SELECT * FROM penjualan";
$result = $conn->query($sql);
//include 'template_admin.php';
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