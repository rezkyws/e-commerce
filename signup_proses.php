<?php
$username = $_POST['username'];
$pass	  = $_POST['password'];

require('connection.php');


$user = mysqli_query($conn, "INSERT INTO customer (username, password) VALUES ('$username', '$pass')");
$_SESSION['username'] = $username;
echo $_SESSION['username'];
mysqli_close($conn);
header("location:form_signup_completion.php?id=$username");
//$check = mysqli_num_rows($user);
//if($check>0)
//{
//    session_start();
//    $row = mysqli_fetch_array($user);
//    $_SESSION['username'] = $row['username'];
//    header("location:user.php?");
//}else
//{
//    header("location:form_login_register.php");
//}

?>
