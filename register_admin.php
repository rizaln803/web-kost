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

if(isset($_POST["register"])){
    if(registrasi_b($_POST) > 0){
        echo "<script>alert('Registrasi berhasil.');
                document.location.href = 'login.php';</script>";
    }else{
        echo mysqli_error($conn);
    }
}

if(isset($_POST["cari"])){
    $_SESSION['mysearch']= $_POST["masukan"];
    header("Location: search.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <link rel="stylesheet" type="text/css" href="style/style_register_b.css">
    <title>Owner Register : Kost Ketintang</title>
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
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="">Kategori</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="">Bantuan</a>
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
        <div class="top-wrapper">
            <form action="" method="post" autocomplete="off">
                <p class="title-text">Kost Ketintang</h1>
                <p class="register-text">Owner Registration Form</p>
                <div class="rows">
                <div class="column">
                <div class="input-group">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Nama Kost" name="name" required>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Alamat Kost" name="address" required>
                </div>
                </div>
                <div class="column">
                <div class="input-group">
                    <select name="type" required focus>
                        <option value="" disabled selected>Jenis Kost</option> 
                        <option value="Kost Putra">Kost Putra</option>        
                        <option value="Kost Putri">Kost Putri</option>
                        <option value="Kost Campur">Kost Campur</option>               
                    </select>
                </div>
                <div class="input-group">
                    <input type="number" placeholder="Nomor HP" name="phone" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Konfirmasi Password" name="cpassword" required>
                </div>
                </div>
                </div>
                <div class="input-group">
                    <button type="submit" name="register" class="btn">Register</button>
                </div>
                <p class="description-text">Sudah punya akun? Masuk di <a class ="login-text" href="login.php">sini</a></p>
            </form>
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
</body>
</html>