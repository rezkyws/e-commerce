<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahasiswa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// include database connection file

// Get id from URL to delete that user
$nim = $_GET['nim'];

// Delete user row from table based on given id
$sql = "DELETE FROM data_diri_mahasiswa WHERE nim = $nim";
$result = $conn->query($sql);

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:template.php?content=mahasiswa.php");
?>