<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$username = $_SESSION['myusername'];
$profile = query("SELECT * FROM users INNER JOIN payments ON users.id = payments.id_user");

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
        <div class="top-wrapper border border-muted pt-3 pb-5 rounded-3 border-2">
            <h1 class="mb-3 border-bottom">User Dashboard</h1>
            <h3 class="mb-3">Daftar Transaksi</h3>
            <div class="form-wrapper">
                <?php foreach($profile as $prf) : ?>
                <div class="col-5 m-3 p-3 border border-muted rounded-3 border-2">
                    <img class="mb-3 w-100" style="height: 200px;" src="img/<?= $prf["photo_room"]; ?>" alt="">
                    <p class="text-decoration-none h5" style="color: #74b9ff;" href=""><?= $prf["name_kost"]; ?> (<?= $prf["name_room"]; ?>)</p>
                    <p class="mb-1 p-1 bg-warning text-white d-inline-block rounded-3"><?= $prf["type_kost"]; ?></p>
                    <p class="mb-1"><?= $prf["address_kost"]; ?></p>
                    <p class="mb-1 text-success">Total Bayar: Rp. <?= $prf["total_price"]; ?></p>
                    <?php if($prf["status"] == "Belum Dibayar") : ?>
                        <p class="mb-1 fw-bold text-danger">BELUM DIBAYAR</p>
                        <a href="pay_room.php?&id=<?= $prf["id"]; ?>" onclick="return confirm('Selesaikan transaksi?');" class="h5 mb-1 me-1 btn btn-info text-white d-inline-block">Bayar</a>
                        <a href="cancel_rent.php?&id=<?= $prf["id"]; ?>" onclick="return confirm('Batalkan transaksi?');" class="h5 mb-1 btn btn-danger text-white d-inline-block">Batal</a>
                    <?php elseif($prf["status"] == "Sudah Dibayar") : ?>
                        <p class="mb-1 fw-bold text-info">SUDAH DIBAYAR</p>
                        <a href="" class="h5 mb-1 btn btn-primary text-white d-inline-block">Bukti Transaksi</a>
                    <?php else : ?>
                        <p class="mb-1 fw-bold text-secondary">DIBATALKAN</p>
                    <?php endif; ?>
                </div>
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