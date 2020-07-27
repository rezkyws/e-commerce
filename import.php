<!DOCTYPE html>
<html>
<head>
	<title>Mari Belajar Coding</title>
	<?php
	include 'koneksii.php';
    include 'template_admin.php';
	$conn = OpenCon();
	?>
</head>
<body>

	<table>
		<!--form upload file-->
		<form method="post" enctype="multipart/form-data" >
			<tr>
				<td>Pilih File</td>
				<td><input name="filemhsw" type="file" required="required"></td>
			</tr>
			<tr>
				<td></td>
				<td><input name="upload" type="submit" value="Import"></td>
			</tr>
		</form>
	</table>
	<?php
	if (isset($_POST['upload'])) {

		require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
		require('spreadsheet-reader-master/SpreadsheetReader.php');

		//upload data excel kedalam folder uploads
		$target_dir = "uploads/".basename($_FILES['filemhsw']['name']);
		
		move_uploaded_file($_FILES['filemhsw']['tmp_name'],$target_dir);

		$Reader = new SpreadsheetReader($target_dir);
        error_reporting(E_ERROR | E_PARSE);

		foreach ($Reader as $Key => $Row)
		{
			// import data excel mulai baris ke-2 (karena ada header pada baris 1)
			if ($Key < 1) continue;			
//			$query=mysql_query("INSERT INTO barang VALUES ('".$Row[0]."', '".$Row[1]."','".$Row[2]."','".$Row[3].", '".$Row[4]."', '".$Row[5].", '".$Row[6]."''')");
            $sql = "INSERT INTO barang VALUES ('".$Row[0]."', '".$Row[1]."','".$Row[2]."','".$Row[3]."','".$Row[4]."','".$Row[5]."')ON DUPLICATE KEY UPDATE 
                            ID_PRODUK = '$Row[0]', NAMA_PRODUK ='$Row[1]', STOK_PRODUK ='$Row[2]', HARGA_BARANG ='$Row[3]', BERAT_BARANG ='$Row[4]',FILE_FOTO='$Row[5]'";
            $result = $conn->query($sql);
            header("location:data_barang.php");
		}
//		if ($query) {
//				echo "Import data berhasil";
//			}
	}
	?>
</body>
</html>