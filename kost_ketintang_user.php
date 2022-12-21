<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

require 'functions.php';

$kata = $_GET["kategori"];
if($kata == "kost_terbaru"){
    $m = "Kamar Kost Terbaru";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user ORDER BY kosts.id DESC");
}elseif($kata == "kost_putra"){
    $m = "Kamar Kost Putra";
    $n = "Kost Putra";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE admins.type = '$n' ORDER BY kosts.id DESC");
}elseif($kata == "kost_putri"){
    $m = "Kamar Kost Putri";
    $n = "Kost Putri";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE admins.type = '$n' ORDER BY kosts.id DESC");
}elseif($kata == "kost_campur"){
    $m = "Kamar Kost Campur";
    $n = "Kost Campur";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE admins.type = '$n' ORDER BY kosts.id DESC");
}elseif($kata == "kost_termurah"){
    $m = "Kamar Kost Termurah";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE kosts.price <= '500000' ORDER BY kosts.price ASC");
}elseif($kata == "semua_kost"){
    $m = "Semua Kamar Kost";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user ORDER BY kosts.id DESC");
}elseif($kata == "kost_terbaik"){
    $m = "Kamar Kost Rating Tinggi";
    $kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE kosts.likes > '0' ORDER BY kosts.likes DESC");
}

if(isset($_POST["cari"])){
    $masukan = $_POST["masukan"];
    header("Location: search_user.php?&cari=$masukan");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="icon" href="images/logo.png" type="image/ico">
    <link rel="stylesheet" type="text/css" href="style/style_index.css">
    <title><?=$m;?> - Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
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
                            <li><a class="dropdown-item" href="kost_ketintang_user.php?&kategori=kost_putra">Kamar Kost Putra</a></li>
                            <li><a class="dropdown-item" href="kost_ketintang_user.php?&kategori=kost_putri">Kamar Kost Putri</a></li>
                            <li><a class="dropdown-item" href="kost_ketintang_user.php?&kategori=kost_campur">Kamar Kost Campur</a></li>
                            <li><a class="dropdown-item" href="kost_ketintang_user.php?&kategori=kost_terbaik">Kamar Kost Rating Tinggi</a></li>
                            <li><a class="dropdown-item" href="kost_ketintang_user.php?&kategori=kost_termurah">Kamar Kost Termurah</a></li>
                            <li><a class="dropdown-item" href="kost_ketintang_user.php?&kategori=semua_kost">Semua Kamar Kost</a></li>
                            </ul>
                         </li>
                        <li class="nav-item ms-4">
                            <a class="nav-link" href="about_user.php">Bantuan</a>
                        </li>
                        <li class="nav-item dropdown ms-4">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Akun</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="rent_list.php">Daftar Transaksi</a></li>
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
        <div class="top-wrapper">
            <div class="catalog-wrapper border border-muted pt-3 pb-5 rounded-3 border-2">
                <h1 class="ps-0 text-decoration-none h1 catalog-title border-bottom" href=""><?=$m;?></h1>
                <?php $i=1; ?>
                <?php foreach($kost as $kmr) : ?>
                <?php if ($kata == "kost_terbaru" || $kata == "kost_terbaik") {
                        if($i == '11'){
                            break;
                        }
                    }
                ?>
                <div style="height:550px;" class="w-50 catalog m-3 p-3 border border-muted rounded-3 border-2">
                    <a href="detail.php?&id=<?= $kmr["id"]; ?>"><img style="height:250px;" class="mb-3" src="img/<?= $kmr["photo"]; ?>" alt=""></a>
                    <br>
                    <a class="text-decoration-none h5" style="color: #74b9ff;" href="detail.php?&id=<?= $kmr["id"]; ?>"><?= $kmr["name"]; ?> (<?= $kmr["room_name"]; ?>)</a>
                    <br>
                    <p class="mt-2 mb-1 me-1 p-1 bg-warning text-white d-inline-block rounded-3"><?= $kmr["type"]; ?></p>
                    <p class="mt-2 mb-1 p-1 bg-warning text-white d-inline-block rounded-3"><i class="bi bi-star-fill"></i> <?= round($kmr["likes"], 2); ?></p>
                    <p class="mt-2 mb-1 text-danger">Sisa Kamar: <?= $kmr["stock"]; ?></p>
                    <p class=" mb-1"><?= $kmr["address"]; ?></p>
                    <p class="mt-2 p-1 bg-success text-white d-inline-block rounded-3">Rp. <?= $kmr["price"]; ?></p>
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