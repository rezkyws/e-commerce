<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .col-25, .col-75, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
<?php
session_start();
$_SESSION['user_id'] = $_GET['id'];

?>

<h2>Selesaikan Pendaftaran</h2>
<p>Silahkan masukkan data diri anda untuk melanjutkan proses order</p>

<div class="container">
    <form action="new_user.php" method="post">
        <div class="row">
            <div class="col-25">
                <label for="name">Nama Lengkap</label>
            </div>
            <div class="col-75">
                <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="hp">No. Hp</label>
            </div>
            <div class="col-75">
                <input type="text" id="hp" name="hp" placeholder="Masukkan No. Hp">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="gender">Jenis Kelamin</label>
            </div>
            <div class="col-75">
                <select id="gender" name="gender">
                    <option value="null">-- Select Gender --</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="subject">Alamat Lengkap</label>
            </div>
            <div class="col-75">
                <textarea id="alamat" name="alamat" placeholder="Masukkan Alamat Lengkap" style="height:200px"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="pos">Kode Pos</label>
            </div>
            <div class="col-75">
                <input type="text" id="pos" name="pos" placeholder="Masukkan Kode Pos">
            </div>
        </div>
        <div class="row">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>


</body>
</html>
