<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["id"];
$username = $_SESSION['myusername'];
$user = query("SELECT * FROM users WHERE username = '$username'");
$profile = query("SELECT * FROM admins INNER JOIN kosts ON admins.id = kosts.id_user WHERE kosts.id = '$id'");
$komen = query("SELECT * FROM comments WHERE id_room = '$id' ORDER BY id DESC");

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search_user.php");
    exit;
}

if(isset($_POST["post_comment"])){
    if(komen($_POST) > 0){
        echo "<script>alert('Pertanyaan berhasil dikirim.');
                document.location.href = 'detail.php?&id=$id';</script>";
    }else{
        echo "<script>alert('Pertanyaan gagal dikirim.');
                document.location.href = 'detail.php?&id=$id';</script>";
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
        <h1 class="mb-3 border-bottom">Detail Kamar Kost</h1>    
        <div class="form-wrapper">
                <?php foreach($profile as $kmr) : ?>
                    <img class="mb-3" height=400 src="img/<?= $kmr["photo"]; ?>" alt="">
                    <h1 class="mb-3" style="color: #74b9ff;"><?= $kmr["name"]; ?> (<?= $kmr["room_name"]; ?>)</h1>
                    <p class="mt-2 h5 p-2 mb-1 me-1 bg-warning text-white d-inline-block rounded-3"><?= $kmr["type"]; ?></p>
                    <p class="mt-2 h5 p-2 mb-1 bg-danger text-white d-inline-block rounded-3">Sisa Kamar: <?= $kmr["stock"]; ?></p>
                    <p class="mt-2 h5 mb-3">Alamat: <?= $kmr["address"]; ?></p>
                    <h3 class="mb-1 border-bottom d-inline-block">Deskripsi Kamar</h3>
                    <p class="mt-1 w-50 mb-3"><?= $kmr["description"]; ?></p>
                    <p class="h5 p-2 mb-1 bg-success text-white d-inline-block rounded-3">Rp. <?= $kmr["price"]; ?>/Bulan</p>
                    <?php if($kmr["stock"] == 0) : ?>
                        <a class="btn h5 p-2 btn-secondary text-white mt-2 d-block rounded-3 mb-3 disabled" name="rent" href="payment.php?&id=<?= $id; ?>">Ajukan Sewa</a>
                    <?php else : ?>
                        <a class="btn h5 p-2 btn-info text-white mt-2 d-block rounded-3 mb-3" name="rent" href="payment.php?&id=<?= $id; ?>">Ajukan Sewa</a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="headings d-flex justify-content-between align-items-center mb-2">
                        <h3 class="text-center border-bottom">Diskusi</h3>
                    </div>
                    <?php foreach($komen as $kmn) : ?>
                    <?php 
                        $ids = $kmn["id"];
                        $replies = query("SELECT * FROM replies WHERE id_reply = '$ids' ORDER BY id DESC");
                    ?>
                    <div class="card p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="user d-flex flex-row align-items-center">
                        <span><small class="font-weight-bold text-primary"><?= $kmn["comment_name"]; ?></small> <small class="font-weight-bold"><?= $kmn["comment"]; ?></small></span>
                        </div>
                        <small><?= $kmn["date"]; ?></small>
                        </div>
                    </div>
                        <?php foreach($replies as $kmn) : ?>
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
                    <?php endforeach; ?>
                    <form action="" method="post" autocomplete="off">
                        <?php foreach($user as $kmn) : ?>
                            <input value="<?= $id; ?>" name="id_room" type="hidden">
                            <input value="<?= $kmn["name"]; ?>" name="names" type="hidden">
                        <?php endforeach; ?>
                            <input class="mb-3 small w-100 p-3 rounded-2 border border-1 border-secondary" type="text" placeholder="Ada Pertanyaan?" name="question" required>
                            <button class="p w-100 p-3 btn btn-primary" name="post_comment" type="submit" class="btn">Tanya</button>
                    </form>
                </div>
            </div>
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