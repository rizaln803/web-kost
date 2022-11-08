<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];
$_POST['id'] = $id;
$profile = query("SELECT * FROM admins WHERE id = $id");
if(isset($_POST["submit"])){
    if(tambah($_POST) > 0){
        echo "<script>alert('Data berhasil ditambahkan.');
                document.location.href = 'admin.php?id=$id';</script>";
    }else{
        echo "<script>alert('Data gagal ditambahkan.');
                document.location.href = 'admin.php?id=$id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_add.css">
    <title>Dashboard : Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <ul class="header-right ms-auto navbar-nav">
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="admin.php?id=<?= $id; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="logout.php">Akun</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper container">
        <div class="top-wrapper">
        <h1 class="mb-3 border-bottom">Owner Dashboard</h1>
            <?php $n=1; ?>
            <?php foreach($profile as $prf) : ?>
            <p>Nama Kost    : <?= $prf["name"]; ?></p>
            <p>Alamat       : <?= $prf["address"]; ?></p>
            <p class="mb-3">No. HP       : <?= $prf["phone"]; ?></p>
            <?php endforeach; ?>
            <h3 class="mb-3">Tambah Kamar</h3>
            <div class="form-wrapper">
                <form action="" method="post" autocomplete="off">
                    <div class="input-group">
                        <input type="text" placeholder="Jenis Kamar" name="name" required>
                    </div>
                    <div class="input-group">
                        <input type="number" placeholder="Harga (Rp)" name="price" required>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Deskripsi" name="description">
                    </div>
                    <button class="btn btn-primary mb-3" name="submit">Tambah Kamar</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-left">
            <img class="logos" src="images/logos.png" alt="">
            <p>Cari kost di daerah Ketintang jadi lebih mudah.</p>
        </div>
        <div class="footer-right">
            <div class="title">
                <p>Contact us</p><img src="images/contact.png" alt="">
            </div>
            <p>kostketintang@gmail.com</p>
            <p>(+62)89668599925</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>