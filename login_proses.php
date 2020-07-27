<?php
$username = $_POST['username'];
$pass	  = $_POST['password'];
$id_pegawai = $_POST['id_pegawai'];


require('connection_admin.php');

$user = mysqli_query($connect, "select * from admin where username='$username' and password='$pass'");
$check = mysqli_num_rows($user);
if($check>0)
{
	session_start();
	$row = mysqli_fetch_array($user);
	$_SESSION['admin'] = $row['username'];
	header("location:penjualan.php");
}else
{
	header("location:login.php");
}
$conn->close();
?>
