<?php
session_start();
require('connection.php');
include 'template.php';
$total = 0;
?>
<html>
<head>
    <title>Konfirmasi Order</title>
</head>
<body>
<?php
$n = 1;
$i = 1;
$total_berat = 0;
$berat_non_pembulatan = 0;
$id_transaksi = $_SESSION['id_transaksi'];
$id_pos = $_SESSION['id_pos'];
$username = $_SESSION['username'];
echo "
<div class=\"container\">
    <div class=\"col-6 col-sm-4\">
        <h2>Rincian Pembelian</h2>
    </div>
</div>";
while (isset($_SESSION['id'][$n]))
{
    $id_produk = $_SESSION['id'][$n];
    $jumlahbarang = $_SESSION['jumlah_barang'][$n];

    $sql2 = "SELECT * FROM `barang` where`ID_PRODUK` = $id_produk";
    $result2 = $conn->query($sql2);
    while($row2 = $result2->fetch_assoc())
    {
        $nama = $row2["NAMA_PRODUK"];
        $harga = $row2["HARGA_BARANG"];
        $foto = $row2['FILE_FOTO'];
        $berat = $row2['BERAT_BARANG'];
        $stok = $row2['STOK_PRODUK'];
    }
    $subtotal = $harga*$jumlahbarang;
    $total = $total + $subtotal;
    $berat_sub_total = $berat*$jumlahbarang;
    $total_berat = $total_berat + $berat_sub_total;
    $berat_non_pembulatan = $total_berat;

    $stok = $stok - $jumlahbarang;


    echo "
    <div class=\"container bg-light\">
        <div class=\"row\">
            <div class=\"col-6 col-sm-3\">
                <p><img src=\"./images/$foto\" width=\"200\" height=\"200\" alt=\"\"></p>
            </div>
            <div class=\"col-7 col-sm-4\">
                <h3>$nama</h3>
                <h5>Rp. $harga</h5>
                <h5>Berat $berat kg</h5>
                <h6>Total Berat : $berat_sub_total kg</h6>
                <h6>Sub Total : $subtotal</h6>
                <h6>Jumlah : $jumlahbarang</h6>
            </div>
        </div>
    </div>";

    $sql6 = "INSERT INTO proses_jual (ID_TRANSAKSI, ID_PRODUK, HARGA_PRODUK, JUMLAH_PRODUK) VALUES ('$id_transaksi', '$id_produk', '$harga', '$jumlahbarang')";
    if ($conn->query($sql6) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql6 . "<br>" . $conn->error;
    }

    $sql7 = "UPDATE `barang` SET `STOK_PRODUK` = $stok where `ID_PRODUK` = $id_produk ";
    if ($conn->query($sql7) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql7 . "<br>" . $conn->error;
    }
    $n = $n + 1;
}

//Start ringkasan pembelian

$sql5 = "UPDATE penjualan SET TOTAL_PEMBAYARAN = $total where `ID_TRANSAKSI` = $id_transaksi ";
if ($conn->query($sql5) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql5 . "<br>" . $conn->error;
}


$sql3 = "SELECT * FROM `penjualan` where `ID_TRANSAKSI` = $id_transaksi";
$result3 = $conn->query($sql3);
while($row3 = $result3->fetch_assoc())
{
    $id_transaksi = $row3["ID_TRANSAKSI"];
    $nama = $row3["NAMA_PEMBELI"];
}

//echo"Username = $username<br><br>";
//echo"ID Transaksi = $id_transaksi<br><br>";
//echo"Nama Pembeli = $nama<br><br>";

$sql4 = "SELECT * FROM `ongkir` where `KODE_POS_TUJUAN` = $id_pos";
$result4 = $conn->query($sql4);
while($row4 = $result4->fetch_assoc())
{
    $pos_tujuan = $row4["ID_POS"];
    $ongkir = $row4["biaya_ongkir"];
}
//echo"Kode pos tujuan = $id_pos<br><br>";


//echo"Total Berat = $total_berat kg <br><br>";
$berat_sisa = $total_berat;
$tambahin = 1.0;
$pembulatan = $total_berat;

if ($berat_sisa >= 1) {
    while($berat_sisa >= 1){
        $berat_sisa = $berat_sisa - 1;
    }
    if($berat_sisa == 0){
        $ongkir = $ongkir*$total_berat;
        $pembulatan = $total_berat;
    }else if ($berat_sisa > 0.3) {
        $tambahin = $tambahin - $berat_sisa;
        $total_berat = $total_berat + $tambahin;
        $pembulatan = (int) $total_berat;
        $ongkir = $ongkir*$pembulatan;
    }else {
        $total_berat = $total_berat - $berat_sisa;
        $pembulatan = (int) $total_berat;
        $ongkir = $ongkir*$pembulatan;
    }
} else {
    $total_berat = $total_berat - $berat_sisa;
    $pembulatan = (int) $total_berat;
    $pembulatan = $pembulatan + 1;
    $ongkir = $ongkir*$pembulatan;
}

//echo"Pembulatan Berat = $pembulatan kg <br><br>";

$sql9 = "UPDATE penjualan SET KODE_POS = $id_pos where `ID_TRANSAKSI` = $id_transaksi ";
if ($conn->query($sql9) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql9 . "<br>" . $conn->error;
}

//echo"Biaya Ongkir = $ongkir<br><br>";
$total_plus_ongkir = $total + $ongkir;

//echo "Total Harga = $total";
//echo'<br><br></td>';
//echo"Total Harga + Ongkir = $total_plus_ongkir<br><br>";

$conn->close();
?>

<div class="container">
    <div class="col-6 col-sm-4">
        <h2>Ringkasan Pembelian</h2>
    </div>
</div>
<div class="container bg-light">
    <div class="row">
        <div class="col-7 col-sm-4">
            <h3>Username : <?php echo $username; ?></h3>
            <h3>ID Transaksi : <?php echo $id_transaksi; ?></h3>
            <h3>Nama Pembeli : <?php echo $nama; ?></h3>

        </div>
        <div class="w-100 d-none d-md-block">
        </div>

        <div class="col-7 col-sm-4">
            <h3>Kode pos tujuan : <?php echo $id_pos; ?></h3>
            <h3>Total Berat : <?php echo $berat_non_pembulatan; ?> kg</h3>
            <h3>Pembulatan Berat : <?php echo $pembulatan; ?> kg</h3>
        </div>
        <div class="col-7 col-sm-4">
            <h3>Biaya ongkir : <?php echo $ongkir; ?></h3>
            <h3>Total Harga : <?php echo $total; ?></h3>
            <h3>Total Harga + Ongkir : <?php echo $total_plus_ongkir; ?></h3>
        </div>
    </div>
</div>
<div class="container" style="margin-bottom: 50px; margin-top: 50px">
    <a href="beli_sukses.php" class="btn btn-success" role="button">Konfirmasi</a>
    <a href="form_beli.php" class="btn btn-danger" role="button">Cancel</a>
</div>
<br><br>
</body>
</html>