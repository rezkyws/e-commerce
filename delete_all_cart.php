<?php
session_start();

unset ($_SESSION["id"]);
?>

<html>
<body>
"<script>alert('Keranjang berhasil dikosongkan!');document.location="ViewCart.php"</script>";
</body>
</html>