<?php
session_start();
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
include 'template.php';
$total = 0;
$conn = OpenCon();
?>

<?php
$n = 1;
while (isset($_SESSION['id'][$n]))
{
    $id = $_SESSION['id'][$n];
    $jumlahbarang = $_SESSION['jumlah_barang'][$n];

    $sql2 = "SELECT * FROM `barang` where`ID_PRODUK` = $id";
    $result2 = $conn->query($sql2);
    while($row2 = $result2->fetch_assoc())
    {
        $nama = $row2["NAMA_PRODUK"];
        $harga = $row2["HARGA_BARANG"];
        $foto = $row2['FILE_FOTO'];
        $berat = $row2['BERAT_BARANG'];
    }
    $subtotal = $harga*$jumlahbarang;
    $total = $total + $subtotal;
    $berat_total = $berat*$jumlahbarang;



    $n = $n +1;
}

CloseCon($conn);
?>


<html>
<head>
    <title>Cart</title>
</head>
<body>
<div class="container">
    <div class="col-6 col-sm-4">
        <h2>Your Cart</h2>
    </div>
</div>
<div class="container bg-light">
    <div class="row">
        <div class="col-6 col-sm-3">
            <p><img src="./images/<?php echo $foto?>" width="200" height="200" alt=""></p>
        </div>
        <div class="col-6 col-sm-2">
            <h3><?php echo $nama; ?></h3>
            <h5>Rp. <?php echo $harga; ?></h5>
            <h5>Berat <?php echo $berat; ?> kg</h5>
            <h6>Total Berat : <?php echo $berat_total;?> kg</h6>
            <h6>Sub Total : <?php echo $subtotal;?></h6>
        </div>
        <div class="col-6 col-sm-4">
            <br><br><br><br><br>
            Jumlah : <input type='number' min='1' name='jumlah_barang' value=<?php echo $jumlahbarang;?>>
            <a href="view_deletecart.php?id='.$n.'"><img src="./images/delete.png" width="30" height="30" alt=""></a>
        </div>
        <div class="col-6 col-sm-3">
            <h3>Ringkasan Belanja</h3>
            <h5>Total Harga : <?php echo $total;?></h5>
        </div>
    </div>
</div>
</body>
</html>

<!-- Force next columns to break to new line at md breakpoint and up -->
<div class="w-100 d-none d-md-block">
</div>

<div class="col-6 col-sm-4">

</div>
<div class="col-6 col-sm-4"></div>
</div>




<!--<table style="whargabarangbarangth:30%" align="center"; border=1;>-->
<!--	<tr>-->
<!--	<th>Kode</th>-->
<!--	<th>Barang</th>-->
<!--	<th>Foto</th>-->
<!--	<th>Harga</th>-->
<!--	<th>Berat</th>-->
<!--        <th>Berat Total</th>-->
<!--	<th>Jumlah</th>-->
<!--	<th>Subtotal</th>-->
<!--	<th>Delete</th>-->
<!--	</tr>-->
<!--	<br>-->
<!---->
<!--</table>-->
<!--</body>-->
<!--<center>-->

<!--		 <input type="hidden" name="total" value="$total"> <br>-->
<!--         <input type="submit" name="submit" value="Checkout">-->
<!--</form> -->
<!--<a href="form_login_register.php?total='$total'">Checkout<br></a>-->
<!--<a href="delete_all_cart.php">Kosongkan Keranjang<br></a>-->


<!--</center>-->
<!--</html>-->