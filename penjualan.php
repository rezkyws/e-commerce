<html>
<?php
require('connection.php');
$sql = "SELECT * FROM penjualan";
$result = $conn->query($sql);
include 'template_admin.php';
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
            <?php  if ($status == '0' or $status == '1'){ ?>
                <a href="update_status.php?id=<?php echo $row['ID_TRANSAKSI']?>">Update Status </a><br>
            <?php } ?>
            <?php if($status == '2'){ ?>
                <a href="#">Update Status </a><br>
            <?php } ?></td>
        <td><a href="detail_pembelian.php?id=<?php echo $row['ID_TRANSAKSI']
            ?>">Detail Pembelian</a></td>
    </tr>
    <?php
        }
    }
    ?>
    <!-- <td align="center"><a href ="viewcart.php">VIEW CART</a></td>
    <td align="center"><a href="form.php">Add data</a></td> -->
</table>
<center>
    <p><a href="export.php"><button>Export Data ke Excel</button></a></p>
    <p><a href="import.php"><button>Import data barang</button></a></p>
    <p><a href="generate_pdf.php"><button>Export ke PDF</button></a></p>
</center>
</body>
<?php
$conn->close();
?>
</html>