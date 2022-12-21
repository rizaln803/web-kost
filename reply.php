<?php

session_start();

if(!isset($_SESSION["admin"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$username = $_SESSION['myusername'];
$profile = query("SELECT * FROM admins WHERE username = '$username'");
$id = $_GET["id"];
$question = query("SELECT * FROM comments WHERE id = '$id'");
$reply = query("SELECT * FROM replies WHERE id_reply = '$id' ORDER BY id DESC");

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search_admin.php");
    exit;
}

if(isset($_POST["post_reply"])){
    if(balas($_POST) > 0){
        echo "<script>alert('Balasan berhasil dikirim.');
                document.location.href = 'reply.php?&id=$id';</script>";
    }else{
        echo "<script>alert('Balasan gagal dikirim.');
                document.location.href = 'reply.php?&id=$id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style_adprofile.css">
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
            <h3 class="mb-3">Balas Pertanyaan</h3>
            <div class="col-md-8">
                    <div class="headings d-flex justify-content-between align-items-center mb-2">
                        <h3 class="text-center border-bottom">Diskusi</h3>
                    </div>
                    <?php foreach($question as $kmn) : ?>
                    <div class="card p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center">
                        <span><small class="font-weight-bold text-primary"><?= $kmn["comment_name"]; ?></small> <small class="font-weight-bold"><?= $kmn["comment"]; ?></small></span>
                        </div>
                        <small><?= $kmn["date"]; ?></small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php foreach($reply as $kmn) : ?>
                    <div class="ps-5">
                    <div class="card p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center">
                        <span><small class="font-weight-bold text-info"><?= $kmn["owner_name"]; ?></small> <small class="font-weight-bold"><?= $kmn["reply"]; ?></small></span>
                        </div>
                        <small><?= $kmn["date_reply"]; ?></small>
                        </div>
                    </div>
                    </div>
                    <?php endforeach; ?>
                    <form action="" method="post" autocomplete="off">
                        <?php foreach($profile as $kmn) : ?>
                            <input value="<?= $id; ?>" name="id_reply" type="hidden">
                            <input value="<?= $kmn["name"]; ?>" name="names" type="hidden">
                        <?php endforeach; ?>
                        <div class="ps-5">
                            <input class="mb-3 small w-100 p-3 rounded-2 border border-1 border-secondary" type="text" placeholder="Jawab" name="reply" required>
                            <button class="p w-100 p-3 btn btn-info text-white" name="post_reply" type="submit" class="btn">Balas</button>
                        </div>
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