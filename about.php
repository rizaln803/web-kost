<?php

session_start();

if(isset($_SESSION["login"])){
    header("Location: user_home.php");
    exit;
}

if(isset($_SESSION["admin"])){
    header("Location: admin_home.php");
    exit;
}

require 'functions.php';

if(isset($_POST["cari"])){
    $masukan = $_POST["masukan"];
    header("Location: search.php?&cari=$masukan");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="icon" href="images/logo.png" type="image/ico">
    <link rel="stylesheet" type="text/css" href="style/style_login.css">
    <title>About - Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="index.php" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <form class="header-center ms-3 me-auto d-flex" action="" method="post">
                    <input required class="form-control" name="masukan" type="text" placeholder="Cari Kost..." autocomplete="off">
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
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_putra">Kamar Kost Putra</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_putri">Kamar Kost Putri</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_campur">Kamar Kost Campur</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_terbaik">Kamar Kost Rating Tinggi</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_termurah">Kamar Kost Termurah</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=semua_kost">Semua Kamar Kost</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="about.php">Bantuan</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="login.php">Masuk</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="top-wrapper" style="width: 800px; padding: 50px 50px;">
            <h1 class="fw-bold mb-5">About Us<span><img class="float-end" height=75 src="images/logos.png" alt=""></span></h1>
            <p class=""><span class="fw-bold mb-3">Kost Ketintang</span> merupakan website yang ditujukan untuk para pemilik kost dan pencari kost di daerah Ketintang. Pemilik kost dapat menawarkan kostnya disini. Sedangkan pencari kost dapat mencari kost yang sesuai dan melakukan pengajuan sewa.</p>
            <p class="mb-5 text-center"></p>
            <div class="text-center">
            <h3 class="mb-2 fw-bold">Customer Service</h3>
            <p class="m-0">kostketintang@mail.com</p>
            <p class="m-0">(+62)89668599925</p>
            </div>
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