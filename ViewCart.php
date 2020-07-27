<?php
session_start();
require('connection.php');
include 'template.php';
$total = 0;
?>
<html>
<head>
    <title>Cart</title>
</head>
<body>
<?php
$n = 1;
$total = 0;
echo "
<div class=\"container\">
    <div class=\"col-6 col-sm-4\">
        <h2>Your Cart</h2>
    </div>
</div>";
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
    echo "
    <div class=\"container bg-light\">
        <div class=\"row\">
            <div class=\"col-6 col-sm-3\">
                <p><img src=\"./images/$foto\" width=\"200\" height=\"200\" alt=\"\"></p>
            </div>
            <div class=\"col-6 col-sm-2\">
                <h3>$nama</h3>
                <h5>Rp. $harga</h5>
                <h5>Berat $berat kg</h5>
                <h6>Total Berat : $berat_total kg</h6>
                <h6>Sub Total : $subtotal</h6>
            </div>
            <div class=\"col-6 col-sm-4\">
                <br><br><br><br><br>
                <form action='update_jumlah.php?id=$n' method='post'>
                    Jumlah : <input type='number' min='1' name='jumlah_barang' value=$jumlahbarang>
                    <a href=\"view_deletecart.php?id=$n\"><img src=\"./images/delete.png\" width=\"30\" height=\"30\" alt=\"\"></a>
                    <input type=\"submit\" value=\"Save\"><br>
                </form>
            </div>";
    $n = $n +1;
}
$conn->close();
?>
            <div class="col-6 col-sm-4">
                <h3>Ringkasan Belanja</h3>
                <h5>Total Harga : <?php echo $total;?></h5>
            </div>
        </div>
    </div>
<div class="container" style="margin-bottom: 50px; margin-top: 50px">
    <a href="form_login_register.php" class="btn btn-success" role="button">Checkout</a>
    <a href="data_barang.php" class="btn btn-info" role="button">Tambah Barang</a>
    <a href="delete_all_cart.php" class="btn btn-danger" role="button">Kosongkan Keranjang</a>
</div>
<br><br>
</body>
</html>

<!-- Force next columns to break to new line at md breakpoint and up -->
<!--<div class="w-100 d-none d-md-block">-->
<!--</div>-->
<!---->
<!--<div class="col-6 col-sm-4">-->
<!---->
<!--</div>-->
<!--<div class="col-6 col-sm-4"></div>-->
<!--</div>-->




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