<?php
require('connection.php');
$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
include 'template.php';
?>
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans" rel="stylesheet">
    <style>

        a:hover {
            text-decoration: none;
        }
    .main-section{
        margin-top:20px;
    }
    .add-sens{
        position: absolute;
        top:0px;
        right:30px;
    }
    .img-section{
        overflow: hidden;
    }
    .img-section img{
        overflow: hidden;
        width:100px%;
    }
    /*.img-section img:hover{*/
    /*    opacity:0.6;*/
    /*    transition: 0.5s;*/
    /*    cursor: pointer;*/
    /*}*/
    .sectin-title h1{
        font-weight:700;
        font-size:23px;
        color:#285A63;
    }
        #test:hover{
            opacity:0.6;
            transition: 1.5s;
        }
</style>

</head>

<body>
<div class="container main-section" style="font-family: 'Open Sans', sans-serif;">
    <div class="row">
        <?php
            while($row = $result->fetch_assoc()) {
        ?>
        <div class="col-lg-3" id="test">
            <a href="view_detailsbarang.php?id=<?php echo $row['ID_PRODUK']?>">
                <div class="section shadow-sm p-2 mb-5 bg-white rounded" style="box-shadow: 0px 0px 11px 1px rgba(0,0,0,0.28);">
                    <div class="row">
                        <div class="col-lg-12 img-section text-center">
                            <img height="100px" width="100px" src="./images/<?php echo $row['FILE_FOTO']; ?>" class="p-0 m-0 res-ponsive">
                        </div>
                        <div class="col-lg-12 sectin-title">
                            <h1 class="pt-2" style="color: rgba(0, 0, 0, 0.7);font-size: 14px;font-weight: 600;line-height: 19px;"><?php echo $row['NAMA_PRODUK']; ?></h1>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2">
                                    <span style="font-size: 14px;font-weight: bold;color: rgb(250, 89, 29);"><b><?php echo "Rp.".$row['HARGA_BARANG']; ?></b></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12 pb-2">
                            <div class="row">
                                <div class="col-lg-12 text-left">
                                    <span style="font-size: 9px">Tanjung Uban</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
                <?php
            }
        ?>
    </div>
    <div class="text-center">
<!--        <a href="tambah_barang.php">Add data</a><br><hr>-->
<!--        <a href="update_barang.php">Update Barang</a><br>-->
    </div>
</div>

</body>
</html>
<?php
$conn->close();
?>
