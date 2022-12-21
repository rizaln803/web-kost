<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];
$kost = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE kosts.id = '$id'");
$username = $_SESSION['myusername'];
$profile = query("SELECT * FROM users WHERE username = '$username'");

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search_user.php");
    exit;
}

if(isset($_POST["submit"])){
    if(tambahpay($_POST) > 0){
        echo "<script>alert('Pesanan berhasil ditambahkan.');
                document.location.href = 'rent_list.php?&id=$id';</script>";
    }else{
        echo "<script>alert('Pesanan gagal ditambahkan.');
                document.location.href = 'rent_list.php?&id=$id';</script>";
    }
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
        <div class="top-wrapper border border-muted pt-3 pb-5 rounded-3 border-2">
            <h1 class="mb-3 border-bottom">Payment Page</h1>
            <h3 class="mb-3">Detail Pembayaran</h3>
            <div class="form-wrapper">
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
            <?php foreach($profile as $prf) : ?>
                <input type="hidden" name="id" value="<?= $prf["id"]; ?>">
                <input type="hidden" name="name_rent" value="<?= $prf["name"]; ?>">
                <p class="h6 text-secondary m-0">Nama Penyewa</p>
                <div class="input-group">
                        <input type="text" disabled value="<?= $prf["name"]; ?>">
                </div>
            <?php endforeach; ?>
            <?php foreach($kost as $prf) : ?>
            <input type="hidden" name="name" value="<?= $prf["name"]; ?>">
            <input type="hidden" name="photo_room" value="<?= $prf["photo"]; ?>">
            <input type="hidden" name="id_room" value="<?= $prf["id"]; ?>">
            <input type="hidden" name="room_name" value="<?= $prf["room_name"]; ?>">
            <input type="hidden" name="type" value="<?= $prf["type"]; ?>">
            <input type="hidden" name="address" value="<?= $prf["address"]; ?>">
            <input type="hidden" name="price" value="<?= $prf["price"]; ?>">
            <?php endforeach; ?>
            <?php foreach($kost as $prf) : ?>
                <p class="h6 text-secondary m-0">Nama Kost</p>
                <div class="input-group">
                        <input type="text" disabled value="<?= $prf["name"]; ?>">
                </div>
                <p class="h6 text-secondary m-0">Tipe Kamar</p>
                <div class="input-group">
                        <input type="text" disabled value="<?= $prf["room_name"]; ?>">
                </div>
                <p class="h6 text-secondary m-0">Jenis Kost</p>
                <div class="input-group">
                        <input type="text" disabled value="<?= $prf["type"]; ?>">
                </div>
                <p class="h6 text-secondary m-0">Alamat Kost</p>
                <div class="input-group">
                        <input type="text" disabled value="<?= $prf["address"]; ?>">
                </div>
                <p class="h6 text-secondary m-0">Harga (Rp)/Bulan</p>
                <div class="input-group">
                        <input type="number" disabled value="<?= $prf["price"]; ?>">
                </div>
                <div class="input-group">
                        <select name="periode" required focus>
                            <option value="" disabled selected>Durasi Sewa</option> 
                            <option value="1">1 Bulan</option>        
                            <option value="2">2 Bulan</option>
                            <option value="3">3 Bulan</option>               
                        </select>
                </div>
            <?php endforeach; ?>
            <button class="btn btn-info mb-3 text-white" name="submit">Konfirmasi Sewa</button>
            </form>
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