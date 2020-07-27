<?php
$username = $_POST['username'];
$pass	  = $_POST['password'];


require('connection_admin.php');


$user = mysqli_query($connect, "select * from customer where username='$username' and password='$pass'");
$check = mysqli_num_rows($user);
if($check>0)
{
    session_start();
    $row = mysqli_fetch_array($user);
    $_SESSION['username'] = $row['username'];
    header("location:user.php");
}else
{
    header("location:form_login_register.php");
}
$conn->close();
?>
