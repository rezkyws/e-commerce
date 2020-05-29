
<!DOCTYPE HTML>  
<html>
<head>
<style>
form {
  text-align: center;
}
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// buat variable dan set value kosong
$nameErr = $idErr = $hpErr = $alamatErr = $genderErr = $posErr = "";
$name = $id = $hp = $alamat = $gender = $alamat = $pos = "";
$succed = $error = False;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name harus diisi";
  } else {
    $name = test_input($_POST["name"]);
    // cek apakah hanya huruf dan spasi
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "hanya huruf dan spasi yang diperbolehkan";
      $error = True;
    }
  }
  
//   if (empty($_POST["email"])) {
//     $emailErr = "Email harus diisi";
//     $error = True;
//   } else {
//     $email = test_input($_POST["email"]);
//     // check apakah format email benar
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//       $emailErr = "Format email salah";
//       $error = True;
//     }
//   }

  if (empty($_POST["alamat"])) {
    $alamatErr = "Alamat harus diisi";
    $error = True;
  } else {
    $alamat = test_input($_POST["alamat"]);
  }

  if (empty($_POST["hp"])) {
    $hp = "";
  } else {
    $hp = test_input($_POST["hp"]);
    // check apakah format hp benar
    if (!is_numeric($hp)) {
      $hpErr = "Format nomor salah";
      $error = True;
    }
  }

  if (empty($_POST["id"])) {
    $idErr = "id harus diisi";
    $error = True;
  } else {
    $id = test_input($_POST["id"]);
    // check apakah format nim benar
    if (!is_numeric($id)) {
      $idErr = "Format id salah";
      $error = True;
    }
  }

  if (empty($_POST["pos"])) {
    $posErr = "kode pos harus diisi";
    $error = True;
  } else {
    $pos = test_input($_POST["pos"]);
    // check apakah format nim benar
    if (!is_numeric($pos)) {
      $posErr = "Format kode pos salah";
      $error = True;
    }
  }
    
  /*if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }*/

  /*if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }*/



  if (empty($_POST["gender"])) {
    $genderErr = "Gender harus diisi";
    $error = True;
  } else {
    $gender = test_input($_POST["gender"]);


    if ($error == True) {
        $succed = False;
      } else {
        $succed = True;
      }
  }

 
}
  

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2 align="center">Form Pembelian</h2>
<p align="center"><span class="error">* harus diisi</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
 <br><br>
  ID Transaksi: <input type="text" name="id" value="<?php echo $id;?>">
  <span class="error">*<?php echo $idErr;?></span>
  <br><br>
  Nama: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <!-- <br><br>


  <br><br> -->
  <br><br>
  Alamat: <textarea name="alamat" rows="5" cols="40"><?php echo $alamat;?></textarea>
  <span class="error">*<?php echo $alamatErr;?></span>
  <br><br>
  HP: <input type="text" name="hp" value="<?php echo $hp;?>">
  <span class="error"><?php echo $hpErr;?></span>
  <br><br>

  Kode Pos: <input type="text" name="pos" value="<?php echo $pos;?>">
  <span class="error">* <?php echo $posErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="pria") echo "checked";?> value="pria">pria
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="wanita") echo "checked";?> value="wanita">wanita
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
<center>
<a href="template.php?content=<?php echo 'ViewCart.php'?>">Kembali</a>
</center>


<?php
session_start();
$i =1;
$_SESSION['id_transaksi'][$i] = $id;
$_SESSION['id_pos'][$i] = $pos;
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "toko_online");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$tgl = date('Y-m-d');
/* Escape user inputs for security
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$hp = mysqli_real_escape_integer($link, $_REQUEST['hp']);
$nim = mysqli_real_escape_integer($link, $_REQUEST['nim']);
$gender = mysqli_real_escape_string($link, $_REQUEST['gender']);*/
 
// Attempt insert query execution
if($succed == True){
$sql = "INSERT INTO penjualan (NAMA_PEMBELI, ALAMAT, NO_HP, ID_TRANSAKSI, TGL_TRANSAKSI, STATUS_PENJUALAN) VALUES ('$name', '$alamat', '$hp', '$id', '$tgl', '0')";
if(mysqli_query($link, $sql)){
    echo "Data dimasukkan";
    //  header("location:summary.php");
    header("location:template.php?content=summary.php");
} else{
    echo "ERROR";
}
}

// $sql2 = "INSERT INTO ongkir (POS_TUJUAN, ID_TRANSAKSI) VALUES ('$pos', '$id')";
// if(mysqli_query($link, $sql2)){
//     echo "Data dimasukkan";
//     header("location:summary.php");
// } else{
//     echo "ERROR";
// }
// }
 
// Close connection
mysqli_close($link);
?>

</body>
</html>
