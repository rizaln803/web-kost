<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];
$kost = query("SELECT * FROM kosts WHERE id_user = $id");
$profile = query("SELECT * FROM admins WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard : Kost Ketintang</title>
    <link rel="stylesheet" href="style/style_admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <form class="header-center ms-3 me-auto d-flex" action="">
                    <input class="form-control" type="text" placeholder="Cari Kost...">
                    <button class="btn" type="button">Cari</i></button>
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
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
            <h3 class="mb-3 text-center">Daftar Kamar</h3>
            <a class="btn btn-primary mb-3" name="add" href="add.php?id=<?= $id; ?>">Tambah Kamar</a>
            <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Aksi</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach($kost as $kst) : ?>
                    <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td>
                        <a class="btn btn-secondary mb-1 me-1 text-decoration-none" href="update.php?id=<?= $id; ?>&ids=<?= $kst["id"]; ?>" onclick="
                        return confirm('Ubah data?');">Ubah</a>
                        <a class="btn btn-danger text-decoration-none" href="hapus.php?id=<?= $id; ?>&ids=<?= $kst["id"]; ?>" onclick="
                        return confirm('Hapus data?');">Hapus</a>
                    </td>
                    <td><?= $kst["name"]; ?></td>
                    <td>Rp. <?= $kst["price"]; ?></td>
                    <td><img width="200" src="img/<?= $kst["photo"]; ?>" alt=""></td>
                    <td width="300"><?= $kst["description"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>
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
            <p class="mb-0">kostketintang@gmail.com</p>
            <p class="mb-0">(+62)89668599925</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>