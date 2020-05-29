<?php
session_start();

unset ($_SESSION["id"]);
?>

<html>
<body>
"<script>alert('Cart telah dikosongkan!');document.location="template.php?content=ViewCart.php"</script>";
</body>
</html>