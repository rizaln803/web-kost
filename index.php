<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$kost = query("SELECT * FROM kosts");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <link rel="stylesheet" type="text/css" href="style/style_index.css">
    <title>Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <form class="header-center ms-3 me-auto d-flex" action="">
                    <input class="form-control" type="text" placeholder="Cari Kost...">
                    <button class="btn" type="button">Cari</i></button>
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="header-right ms-auto navbar-nav">
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="">Beranda</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="">Kategori</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="">Bantuan</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="logout.php">Masuk</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="catalog-wrapper border border-muted pt-3 pb-5 rounded-3 border-2">
            <a class="text-decoration-none m-3 h1 catalog-title" href="">Daftar Kamar</a>
            <?php foreach($kost as $kmr) : ?>
            <div class="catalog m-3 p-3 border border-muted rounded-3 border-2 w-50">
                <a href=""><img class="mb-3 w-100" src="img/<?= $kmr["photo"]; ?>" alt=""></a>
                <?php 
                $ids = $kmr["id_user"];
                $owner = query("SELECT * FROM admins WHERE id = $ids");
                foreach($owner as $own) : ?>
                <a class="text-decoration-none h5" style="color: #74b9ff;" href=""><?= $own["name"]; ?> (<?= $kmr["name"]; ?>)</a>
                <p class="mt-2 mb-1"><?= $own["address"]; ?></p>
                <?php endforeach; ?>
                <p>Rp. <?= $kmr["price"]; ?></p>
            </div>
            <?php endforeach; ?>
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
            <p class="mb-0">kostketintang@gmail.com</p>
            <p class="mb-0">(+62)89668599925</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>