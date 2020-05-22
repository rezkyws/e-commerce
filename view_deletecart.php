<?php
session_start();
$n = $_GET['id'];
if (isset($_SESSION['id'][$n+1]))
{
	
	echo $n;
	while(isset($_SESSION['id'][$n+1]))
	{
		$_SESSION['id'][$n] = $_SESSION['id'][$n+1];
		$_SESSION['jumlahbarang'][$n] = $_SESSION['jumlahbarang'][$n+1];
		$_SESSION['idpembeli'][$n] = $_SESSION['idpembeli'][$n+1];
		$n = $n + 1;
	}
	echo $n;
	echo '<br>';//naik satu
	echo $_SESSION['id'][$n-1];
	unset ($_SESSION['id'][$n]);
	unset ($_SESSION['jumlahbarang'][$n]);
	unset ($_SESSION['idpembeli'][$n]);    
}
else
{    
	unset ($_SESSION['id'][$n]);
	unset ($_SESSION['jumlahbarang'][$n]);
	unset ($_SESSION['idpembeli'][$n]);    
}

?>
<meta http-equiv="refresh" content="0;URL=template.php?content=<?php echo 'data_barang.php'?>" />