<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$username = $_SESSION['myusername'];
$profile = query("SELECT * FROM admins WHERE username = '$username'");
foreach($profile as $prf) :
    $ids = $prf["id"];
endforeach;
$kost = query("SELECT * FROM kosts WHERE id_user = $ids");

if(isset($_POST["cari"])){
    $masukan = $_POST["masukan"];
    header("Location: search_admin.php?&cari=$masukan");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" type="image/ico">
    <title>Owner Dashboard - Kost Ketintang</title>
    <link rel="stylesheet" href="style/style_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="index.php" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <form class="header-center ms-3 me-auto d-flex" action="" method="post">
                    <input class="form-control" required name="masukan" type="text" placeholder="Cari Kost..." autocomplete="off">
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
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="kost_ketintang_admin.php?&kategori=kost_putra">Kamar Kost Putra</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang_admin.php?&kategori=kost_putri">Kamar Kost Putri</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang_admin.php?&kategori=kost_campur">Kamar Kost Campur</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang_admin.php?&kategori=kost_terbaik">Kamar Kost Rating Tinggi</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang_admin.php?&kategori=kost_termurah">Kamar Kost Termurah</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang_admin.php?&kategori=semua_kost">Semua Kamar Kost</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="about_admin.php">Bantuan</a>
                    </li>
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Akun</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="question.php">Daftar Pertanyaan</a></li>
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
            <h3 class="mb-3">Daftar Kamar</h3>
            <a class="btn btn-primary mb-3" name="add" href="add_room.php">Tambah Kamar</a>
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($kost as $kst) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                        <a class="btn btn-secondary mb-1 me-1 text-decoration-none" href="update_room.php?id=<?= $kst["id"]; ?>">Ubah</a>
                        <a class="btn btn-danger mb-1 text-decoration-none" href="delete_room.php?&id=<?= $kst["id"]; ?>" onclick="
                        return confirm('Hapus data?');">Hapus</a>
                    </td>
                    <td><?= $kst["room_name"]; ?></td>
                    <td>Rp. <?= $kst["price"]; ?></td>
                    <td><img width="150" src="img/<?= $kst["photo"]; ?>" alt=""></td>
                    <td width="300"><?= $kst["description"]; ?></td>
                    <td><?= $kst["stock"]; ?></td>
                    <td><?= round($kst["likes"], 2); ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>
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