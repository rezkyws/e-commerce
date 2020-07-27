<?php
//$servername = "localhost";
//$user = "hadaetea_userRezky";
//$password = "pswd_had3ae";
//$dbname = "hadaetea_dbRezky";

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "toko_online";


//$host = "localhost";
//$user = "root";
//$password = "";
//$database = "toko_online";
//$connect = mysqli_connect($host, $user, $password, $database);


// Create connection
$conn = new mysqli($servername, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>