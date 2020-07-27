<?php
session_start();
require('connection.php');
$user_id = $_SESSION['username'];

?>

<?php
$user = mysqli_query($conn, "select * from customer where username='$user_id'");
$check = mysqli_num_rows($user);
if($check>0)
{
    $row = mysqli_fetch_array($user);
    $name = $row["nama_lengkap"];
    $alamat = $row["alamat"];
    $hp = $row["hp"];
    $username = $row["username"];
    $pos = $row["KODE_POS"];
}else
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$tgl = date('Y-m-d H:i:s');
    //session_start();
    $sql2 = "INSERT INTO penjualan (NAMA_PEMBELI, ALAMAT, NO_HP, fk_customer, TGL_TRANSAKSI, STATUS_PENJUALAN, KODE_POS) VALUES ('$name', '$alamat', '$hp', '$username', '$tgl', '0', '$pos')";
    mysqli_query($conn,$sql2);
    $_SESSION['id_transaksi'] = mysqli_insert_id($conn);
    $_SESSION['id_pos'] = $pos;
    $_SESSION['username'] = $username;
    header("location:summary.php");
$conn->close();
?>