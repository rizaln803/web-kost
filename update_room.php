<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];
$username = $_SESSION['myusername'];
$profile = query("SELECT * FROM admins WHERE username = '$username'");
$kamar = query("SELECT * FROM kosts WHERE id = $id")[0];
if(isset($_POST["submit"])){
    if(ubah($_POST) > 0){
        echo "<script>alert('Data berhasil diubah.');
                document.location.href = 'admin.php';</script>";
    }else{
        echo "<script>alert('Data gagal diubah.');
                document.location.href = 'admin.php';</script>";
    }
}

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_update.css">
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
        <div class="top-wrapper pt-3 pb-5">
            <h1 class="mb-3 border-bottom">Owner Dashboard</h1>
            <?php foreach($profile as $prf) : ?>
            <p>Nama Kost    : <?= $prf["name"]; ?></p>
            <p>Jenis Kost   : <?= $prf["type"]; ?></p>
            <p>Alamat Kost  : <?= $prf["address"]; ?></p>
            <p class="mb-3">No. HP       : <?= $prf["phone"]; ?></p>
            <?php endforeach; ?>
            <h3 class="mb-3">Ubah Data Kamar</h3>
            <div class="form-wrapper">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="gambar_lama" value="<?= $kamar["photo"]; ?>">
                    <input type="hidden" name="id" value="<?= $kamar["id"]; ?>">
                    <p class="h6 text-secondary m-0">Tipe Kamar</p>
                    <div class="input-group">
                        <input type="text" name="room_name" required value="<?= $kamar["room_name"]; ?>">
                    </div>
                    <p class="h6 text-secondary m-0">Harga (Rp)/Bulan</p>
                    <div class="input-group">
                            <input type="number" name="price" required value="<?= $kamar["price"]; ?>">
                    </div>
                    <p class="h6 text-secondary m-0">Deskripsi Kamar</p>
                    <div class="input-group">
                            <input type="text" name="description" value="<?= $kamar["description"]; ?>">
                    </div>
                    <p class="h6 text-secondary m-0">Jumlah Kamar</p>
                    <div class="input-group">
                            <input type="number" name="stock" required value="<?= $kamar["stock"]; ?>">
                    </div>
                        <p class="h6 text-secondary m-0">Foto Kamar</p>
                        <img class="mb-3" width="400" src="img/<?= $kamar["photo"]; ?>" alt="">
                    <div class="input-group">
                        <input type="file" name="photo" accept="image/*">
                    </div>
                    <button class="btn btn-primary mb-2" name="submit">Ubah Data</button>
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