
<?php
//include 'data_barang.php';
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "mahasiswa";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
function CloseCon($conn)
{
    $conn -> close();
}
$conn = OpenCon();

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$fotolama = $_POST['foto_lama'];
$id = $_POST['id'];

echo $_POST['foto_lama'];

if(!file_exists($_FILES['gambar']['tmp_name']) || !is_uploaded_file($_FILES['gambar']['tmp_name'])) {
    $sql = "UPDATE data_barang SET nama= '$nama',harga= '$harga' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data Produk Berhasil disimpan ke database');
        document.location='template.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{
    $image_name = $_FILES["gambar"]["name"];
    $image_type = $_FILES['gambar']['type'];
    $image_size = $_FILES['gambar']['size'];
    $image_tmp_name = $_FILES['gambar']['tmp_name'];
    unlink("foto/$fotolama"); 
    echo $fotolama;
    move_uploaded_file($image_tmp_name, "foto/$image_name");
    $sql = "UPDATE data_barang SET nama= '$nama', harga= '$harga', namafilefoto = '$image_name' WHERE id='$id'";
    $conn->query($sql);
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data Produk Berhasil disimpan ke database');
        document.location='template.php'</script>";
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>