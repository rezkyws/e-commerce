<?php
require('connection.php');
$sql = "SELECT * FROM `proses_jual` WHERE ID_TRANSAKSI =".$_GET['id'];
$result = $conn->query($sql);
$grand_berat = 0;
$total_harga = 0;
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
        <td>Berat</td>
        <td>Berat Sub-Total</td>
        <td>Harga Sub-Total</td>
    </tr>
    <tr>
        <?php
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        ?>
        <td><?php
            echo $row["ID_PRODUK"];
            $id_produk = $row["ID_PRODUK"];
            $sql4 = "SELECT * FROM `penjualan` WHERE ID_TRANSAKSI =".$_GET['id'];
            $result4 = $conn->query($sql4);
            $row4 = $result4->fetch_assoc();
            $pos_tujuan = $row4["KODE_POS"];
            ?></td>
        <td><?php
            $sql2 = "SELECT * FROM barang WHERE ID_PRODUK = $id_produk";
            $result2 = $conn->query($sql2);
            $row2 = $result2->fetch_assoc();
            $nama = $row["ID_PRODUK"];
            echo $row2["NAMA_PRODUK"];
            ?></td>
        <td><?php
            $harga_produk = $row["HARGA_PRODUK"];
            echo $row["HARGA_PRODUK"];
            ?></td>
        <td><?php
            $quantity = $row["JUMLAH_PRODUK"];
            echo $row["JUMLAH_PRODUK"];
            ?></td>
        <td><?php
            $berat = $row2["BERAT_BARANG"];
            $total_berat = $berat*$quantity;
            echo $row2["BERAT_BARANG"];
            ?></td>
        <td><?php
            echo $total_berat;
            $grand_berat = $grand_berat + $total_berat;
            ?></td>
        <td><?php
            $sub_total = $quantity*$harga_produk;
            $total_harga = $total_harga + $sub_total;
            echo $sub_total;
            ?></td>
    </tr>
    <?php
    }
    }
    ?>
    <tr>
        <td><?php
            echo "Jumlah";
            ?></td>
        <td><?php
            echo $total_harga;
            ?></td>
    </tr>
</table>
<br><br>
<table border= "1", align = "center">
    <tr bgcolor = #f5f5dc>
        <!--        <td>ID Transaksi</td>-->
        <td>Total berat</td>
        <td>Pembulatan</td>
        <td>Biaya Ongkir</td>
        <td>Total Pembayaran</td>
    </tr>
    <tr>
        <td><?php
            echo $grand_berat;
            ?></td>
        <td><?php
            $sql3 = "SELECT * FROM ongkir WHERE KODE_POS_TUJUAN = $pos_tujuan";
            $result3 = $conn->query($sql3);
            $row3 = $result3->fetch_assoc();
            $ongkir = $row3['biaya_ongkir'];
            $berat_sisa = $grand_berat;
            $tambahin = 1.0;
            if ($berat_sisa >= 1) {
                while($berat_sisa >= 1){
                    $berat_sisa = $berat_sisa - 1;
                }

                if($berat_sisa == 0){
                    $ongkir = $ongkir*$grand_berat;

                }else if ($berat_sisa > 0.3) {
                    $tambahin = $tambahin - $berat_sisa;
                    $total_berat = $total_berat + $tambahin;
                    $grand_berat = (int) $grand_berat;
                    $grand_berat = $grand_berat + 1;
                    $ongkir = $ongkir*$grand_berat;
                }else {
                    $total_berat = $total_berat - $berat_sisa;
                    $grand_berat = (int) $grand_berat;
                    $ongkir = $ongkir*$grand_berat;
                }
            } else {
                $total_berat = $total_berat - $berat_sisa;
                $grand_berat = (int) $total_berat;
                $grand_berat = $grand_berat + 1;
                $ongkir = $ongkir*$grand_berat;
            }
            echo $grand_berat;
            ?></td>
        <td><?php
            echo $ongkir;
            ?></td>
        <td><?php
            echo $total_harga = $total_harga + $ongkir;
            ?></td>
    </tr>
    <!-- <td align="center"><a href ="viewcart.php">VIEW CART</a></td>
    <td align="center"><a href="form.php">Add data</a></td> -->
</table>
<center>
    <a href="penjualan.php">Kembali</a>
</center>
</body>
<?php
$conn->close();
?>
</html>