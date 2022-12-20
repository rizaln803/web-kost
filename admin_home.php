<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user ORDER BY kosts.id DESC");
$cowok = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE admins.type = 'Kost Putra' ORDER BY kosts.id DESC");
$cewek = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE admins.type = 'Kost Putri' ORDER BY kosts.id DESC");
$campur = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE admins.type = 'Kost Campur' ORDER BY kosts.id DESC");

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search_admin.php");
    exit;
}

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
                        <a class="nav-link" href="admin.php">Dashboard</a>
                    </li>
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
                        <li><a class="dropdown-item" href="admin_profile.php">Edit Akun</a></li>
                        <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper container">
        <div class="top-wrapper">
            <div class="catalog-wrapper border border-muted pt-3 pb-5 rounded-3 border-2 row">
                <a class="ps-0 text-decoration-none h1 catalog-title border-bottom" href="">Kamar Kost Terbaru</a>
                <?php $i=1; ?>
                <?php foreach($kost as $kmr) : ?>
                <?php if($i == '5') {
                        break;
                    }
                ?>
                <div class="catalog col m-3 p-3 border border-muted rounded-3 border-2">
                    <a href=""><img class="mb-3" src="img/<?= $kmr["photo"]; ?>" alt=""></a>
                    <a class="text-decoration-none h5" style="color: #74b9ff;" href=""><?= $kmr["name"]; ?><br>(<?= $kmr["room_name"]; ?>)</a>
                    <p class="mt-2 mb-1 text-warning"><?= $kmr["type"]; ?></p>
                    <p class="mt-2 mb-1 text-danger">Sisa Kamar: <?= $kmr["stock"]; ?></p>
                    <p class="mt-2 mb-1"><?= $kmr["address"]; ?></p>
                    <p class="text-success">Rp. <?= $kmr["price"]; ?></p>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="top-wrapper">
            <div class="catalog-wrapper border border-muted pt-3 pb-5 rounded-3 border-2 row">
                <a class="ps-0 text-decoration-none h1 catalog-title border-bottom" href="">Kamar Kost Putra Terbaru</a>
                <?php $i=1; ?>
                <?php foreach($cowok as $kmr) : ?>
                <?php if($i == '5') {
                        break;
                    }
                ?>
                <div class="catalog col m-3 p-3 border border-muted rounded-3 border-2">
                    <a href=""><img class="mb-3" src="img/<?= $kmr["photo"]; ?>" alt=""></a>
                    <a class="text-decoration-none h5" style="color: #74b9ff;" href=""><?= $kmr["name"]; ?><br>(<?= $kmr["room_name"]; ?>)</a>
                    <p class="mt-2 mb-1 text-warning"><?= $kmr["type"]; ?></p>
                    <p class="mt-2 mb-1 text-danger">Sisa Kamar: <?= $kmr["stock"]; ?></p>
                    <p class="mt-2 mb-1"><?= $kmr["address"]; ?></p>
                    <p class="text-success">Rp. <?= $kmr["price"]; ?></p>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="top-wrapper">
            <div class="catalog-wrapper border border-muted pt-3 pb-5 rounded-3 border-2 row">
                <a class="ps-0 text-decoration-none h1 catalog-title border-bottom" href="">Kamar Kost Putri Terbaru</a>
                <?php $i=1; ?>
                <?php foreach($cewek as $kmr) : ?>
                <?php if($i == '5') {
                        break;
                    }
                ?>
                <div class="catalog col m-3 p-3 border border-muted rounded-3 border-2">
                    <a href=""><img class="mb-3" src="img/<?= $kmr["photo"]; ?>" alt=""></a>
                    <a class="text-decoration-none h5" style="color: #74b9ff;" href=""><?= $kmr["name"]; ?><br>(<?= $kmr["room_name"]; ?>)</a>
                    <p class="mt-2 mb-1 text-warning"><?= $kmr["type"]; ?></p>
                    <p class="mt-2 mb-1 text-danger">Sisa Kamar: <?= $kmr["stock"]; ?></p>
                    <p class="mt-2 mb-1"><?= $kmr["address"]; ?></p>
                    <p class="text-success">Rp. <?= $kmr["price"]; ?></p>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="top-wrapper">
            <div class="catalog-wrapper border border-muted pt-3 pb-5 rounded-3 border-2 row">
                <a class="ps-0 text-decoration-none h1 catalog-title border-bottom" href="">Kamar Kost Campur Terbaru</a>
                <?php $i=1; ?>
                <?php foreach($campur as $kmr) : ?>
                <?php if($i == '5') {
                        break;
                    }
                ?>
                <div class="catalog col m-3 p-3 border border-muted rounded-3 border-2">
                    <a href=""><img class="mb-3" src="img/<?= $kmr["photo"]; ?>" alt=""></a>
                    <a class="text-decoration-none h5" style="color: #74b9ff;" href=""><?= $kmr["name"]; ?><br>(<?= $kmr["room_name"]; ?>)</a>
                    <p class="mt-2 mb-1 text-warning"><?= $kmr["type"]; ?></p>
                    <p class="mt-2 mb-1 text-danger">Sisa Kamar: <?= $kmr["stock"]; ?></p>
                    <p class="mt-2 mb-1"><?= $kmr["address"]; ?></p>
                    <p class="text-success">Rp. <?= $kmr["price"]; ?></p>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
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