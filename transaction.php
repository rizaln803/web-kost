<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$username = $_SESSION['myusername'];
$id = $_GET["id"];
$profile = query("SELECT * FROM payments WHERE id=$id");

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_usprofile.css">
    <title>Dashboard : Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="index.php" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <form class="header-center ms-3 me-auto d-flex" action="" method="post">
                    <input class="form-control" name="masukan" type="text" placeholder="Cari Kost..." autocomplete="off">
                    <button class="btn" name="cari" type="submit">Cari</i></button>
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="header-right ms-auto navbar-nav">
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="">Kategori</a>
                        </li>
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="">Bantuan</a>
                        </li>
                        <li class="nav-item dropdown ms-4">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Akun</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="user_profile.php">Edit Akun</a></li>
                            <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper container">
        <div class="top-wrapper justify-content-between align-items-center col-6 border border-muted pt-3 pb-5 rounded-3 border-2">
            <h1 class="mb-5 border-bottom">Transaction Detail</h1>
            <?php foreach($profile as $prf) : ?>
            <p class="h5 mb-4">ID Transaksi     : <?= $prf["id"]; ?></p>
            <p class="h5 mb-4">Nama Penyewa     : <?= $prf["name_rent"]; ?></p>
            <p class="h5 mb-4">Nama Kost        : <?= $prf["name_kost"]; ?></p>
            <p class="h5 mb-4">Tipe Kamar       : <?= $prf["name_room"]; ?></p>
            <p class="h5 mb-4">Jenis Kost       : <?= $prf["type_kost"]; ?></p>
            <p class="h5 mb-4">Alamat Kost      : <?= $prf["address_kost"]; ?></p>
            <p class="h5 mb-4">Harga perBulan   : Rp. <?= $prf["price_room"]; ?></p>
            <p class="h5 mb-4 border-bottom pb-1">Lama Menyewa     : <?= $prf["periode"]; ?> Bulan</p>
            <p class="h5 mb-4">Harga Total      : Rp. <?= $prf["total_price"]; ?></p>
            <p class="h5 mb-4">Status           : <span class="fw-bold text-success"><?= $prf["status"]; ?></span></p>
            <?php endforeach; ?>
        </div>
    </div>
    <footer>
        <div class="container">
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
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</body>
</html>