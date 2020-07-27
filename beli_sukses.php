<?php
session_start();

unset ($_SESSION["id"]);
unset ($_SESSION['id_transaksi']);
unset ($_SESSION['id_pos']);
//unset ($_SESSION['username']);
?>

<html>
<body>
"<script>alert('Pembelian Berhasil!');document.location="data_barang.php"</script>";
</body>
</html>