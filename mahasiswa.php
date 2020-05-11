
<html>
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
$sql = "SELECT * FROM data_diri_mahasiswa";
$result = $conn->query($sql);
?>
<style>
</style>
<head>
    <title>Title</title>
</head>
<body>
<table border="1", align = "center">
    <tr bgcolor = #f5f5dc>
        <td>NIM</td>
        <td>NAMA</td>
        <td>UMUR</td>
        <td>FOTO</td>
        <td>ACTIONS</td>
    </tr>
    <tr>
        <?php
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
        ?>
        <td><?php
            echo $row["nim"];
            ?></td>
        <td><?php
            echo $row["nama"];
            ?></td>
        <td><?php
            echo $row["umur"];
            ?></td>
        <td><img src = "./foto/<?php echo $row['namafilefoto'] ;?>" style = "width: 80px"></td>  
        <td><a href="details.php?nim=
        <a>NIM      :<?php echo $row['nim']; ?>
        <br><a>Nama     :</a><?php echo $row['nama'];?>
        <br><a>Umur     :</a><?php echo $row['umur'];?>
        <br><a>Foto     :<img src ='./foto/<?php echo $row['namafilefoto'] ;?>' width='80px'>

        <br><a>Jenis Kelamin     : </a><?php echo $row['sex'];?>">View Details</a>
        <br><br><a href="delete.php?nim=<?php echo $row['nim']; ?>" style = "text-align: center;">HAPUS</a></td>
    </tr>
    <?php
        }
    }
    ?>
</table>
</body>
<?php
$conn->close();
?>
</html>