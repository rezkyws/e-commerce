<html>
<style>
    table,td,th{
        border: 1;
        font-size: 20;
        align: center
    }

</style>
<body>
<div style="margin: auto; text-align:center">
    <table style="width:30px;text-align:center;border: 1px solid black;">
        <h1 align=center>Rincian Pembelian</h1>
        <br>
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
        $total = 0;
        $conn = OpenCon();
        $n = 1;
        $i = 1;
        // $id_transaksi = '1';
        $total_berat = 0;
        // $_SESSION['id_transaksi'][$i] = $id;
        $id_transaksi = $_SESSION['id_transaksi'][$n];
        $id_pos = $_SESSION['id_pos'][$n];
        $username = $_SESSION['username'][$n];
        echo"ID Transaksi = $username<br><br>";
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
            $berat = $berat*$jumlahbarang;
            $total_berat = $total_berat + $berat;
            $subtotal = $harga*$jumlahbarang;
            $total = $total + $subtotal;
            $stok = $stok - $jumlahbarang;
            echo "========= Barang yang dibeli ===========<br>";

            echo"Nama Produk = $nama<br><br>";

            echo"Harga = Rp.$harga<br><br>";

            echo "Jumlah yang dipesan = $jumlahbarang<br><br>";
            echo"Biaya Subtotal = Rp.$subtotal<br><br>";
            //echo "<td><a href='view_deletecart.php?id=".$n."'>Delete</td>";

            $sql6 = "INSERT INTO proses_jual (ID_TRANSAKSI, ID_PRODUK, HARGA_PRODUK, JUMLAH_PRODUK) VALUES ('$id_transaksi', '$id_produk', '$harga', '$jumlahbarang')";
            if ($conn->query($sql6) === TRUE) {
                echo "";
            } else {
                echo "Error: " . $sql6 . "<br>" . $conn->error;
            }

            $sql7 = "UPDATE barang SET STOK_PRODUK = $stok where `ID_PRODUK` = $id_produk ";
            if ($conn->query($sql7) === TRUE) {
                echo "";
            } else {
                echo "Error: " . $sql7 . "<br>" . $conn->error;
            }
            $n = $n +1;
        }
        echo "========= XX ===========<br>";



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

        echo"ID Transaksi = $id_transaksi<br><br>";
        echo"Nama Pembeli = $nama<br><br>";

        $sql4 = "SELECT * FROM `ongkir` where `KODE_POS_TUJUAN` = $id_pos";
        $result4 = $conn->query($sql4);
        while($row4 = $result4->fetch_assoc())
        {
            $pos_tujuan = $row4["ID_POS"];
            $ongkir = $row4["biaya_ongkir"];
        }
        echo"Kode pos tujuan = $id_pos<br><br>";
        //berat ongkir

        //  if ($total_berat%0.3 == 0.2)
        //  $total_berat =
        echo"Total Berat = $total_berat kg <br><br>";
        $berat_sisa = $total_berat;
        $tambahin = 1.0;
        $pembulatan = $total_berat;

        while($berat_sisa >= 1){
            $berat_sisa = $berat_sisa - 1;
        }


        if($berat_sisa == 0){
            $ongkir = $ongkir*$total_berat;
            $pembulatan = $total_berat;
        }else if ($berat_sisa > 0.3) {
            $tambahin = $tambahin - $berat_sisa;
            $total_berat = $total_berat + $tambahin;
            $ongkir = $ongkir*$total_berat;
            $pembulatan = (int) $total_berat;
        } else {
            $total_berat = $total_berat - $berat_sisa;
            $ongkir = $ongkir*$total_berat;
            $pembulatan = (int) $total_berat;
        }
        echo"Pembulatan Berat = $pembulatan kg <br><br>";

        $sql9 = "UPDATE penjualan SET KODE_POS = $id_pos where `ID_TRANSAKSI` = $id_transaksi ";
        if ($conn->query($sql9) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql9 . "<br>" . $conn->error;
        }
        // if($pos_tujuan == 2 && $berat_sisa > 0.3){
        // 	$tambahin = $tambahin - $berat_sisa;
        // 	$total_berat = $total_berat + $tambahin;
        // 	$ongkir = $ongkir*$total_berat;
        // } else {
        // 	$total_berat = $total_berat - $berat_sisa;
        // 	$ongkir = $ongkir*$total_berat;
        // }


        // if ($pos_tujuan = 2 && $total_berat > 1){
        // 		$ongkir = $ongkir*$total_berat;
        // 	} else {
        // 		$ongkir = 20000*$total_berat;
        // 	}
        // }

        echo"Biaya Ongkir = $ongkir<br><br>";
        $total_harga = $total + $ongkir;

        echo 'Total Harga= Rp.';echo $total;echo'<br><br></td>';
        echo"Total Harga + Ongkir = $total_harga<br><br>";

        // $sql5 = "UPDATE ongkir SET ONGKIR_PERKG = $ongkir where `ID_TRANSAKSI` = $id_transaksi ";
        // if ($conn->query($sql5) === TRUE) {
        // 	echo "";
        // } else {
        // 	echo "Error: " . $sql5 . "<br>" . $conn->error;
        // }

        //error

        CloseCon($conn);
        ?>
    </table>
</div>
</body>
<center>
    <a href="beli_sukses.php" align=left>Konfirmasi<br></a>
    <a href="form_beli.php">Kembali</a>
</center>
</html>