<?php
//Function for database connection
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "toko_online";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
function CloseCon($conn)
{
    $conn -> close();
}

$id = $_POST["id"];
$nama = $_POST["name"];
$harga = $_POST["harga"];
$namafilefoto = $_FILES["namafilefoto"]["name"];
$berat = $_POST["berat"];
$stok = $_POST["stok"];

//for uploading image
$target_dir = "./images/";
$target_file = $target_dir . basename($_FILES["namafilefoto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["namafilefoto"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
  //  $uploadOk = 0;
}
// Check file size
if ($_FILES["namafilefoto"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["namafilefoto"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["namafilefoto"]["name"]). " has been uploaded.";
        header("location:template.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

echo "<br>";

//database query
$conn = OpenCon();
$sql = "INSERT INTO `barang`(`ID_PRODUK`, `NAMA_PRODUK`, `HARGA_BARANG`, `FILE_FOTO`, `STOK_PRODUK`, `BERAT_BARANG`) VALUES ('$id','$nama','$harga','$namafilefoto', '$stok','$berat')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("location:template.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
CloseCon($conn);