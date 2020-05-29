<?php
$username = $_POST['username'];
$pass	  = $_POST['password'];
$id_pegawai = $_POST['id_pegawai'];


include 'connection.php';

$user = mysqli_query($connect, "select * from admin where username='$username' and password='$pass'");
$check = mysqli_num_rows($user);
if($check>0)
{
	session_start();
	$row = mysqli_fetch_array($user);
	$_SESSION['username'] = $row['username'];
	header("location:template_admin.php?content=penjualan.php");
}else
{
	header("location:login.php");
}
?>
