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

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result_a = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $result_a_1 = mysqli_query($conn, "SELECT * FROM users WHERE email = '$username'");
    $result_b = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$username'");
    $result_b_1 = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$username'");

    if(mysqli_num_rows($result_a) == 1){
        $row = mysqli_fetch_assoc($result_a);
        if(password_verify($password, $row["password"])){
            $_SESSION["login"] = true;
            $_SESSION['myusername']= $username;
            header("Location: index.php");
            exit;
        }else{
            echo "<script>alert('Password salah!');</script>";
        }
    // }else if(mysqli_num_rows($result_a_1) == 1){
    //     $row = mysqli_fetch_assoc($result_a_1);
    //     if(password_verify($password, $row["password"])){
    //         $_SESSION["login"] = true;
    //         header("Location: index.php");
    //         exit;
    //     }else{
    //         echo "<script>alert('Password salah!');</script>";
    //     }
    }else if(mysqli_num_rows($result_b) == 1){
        $row = mysqli_fetch_assoc($result_b);
        if(password_verify($password, $row["password"])){
            $query = "SELECT id FROM admins WHERE username='$username'";
            $result = mysqli_query($conn, $query) or die(mysql_error());
            $rows = mysqli_fetch_array($result);
            if(isset($rows['id']) && $rows['id'] > 0){
                $_SESSION["admin"] = true;
                $_SESSION['myusername']= $username;
                header("Location: admin.php");
            }
            exit;
        }else{
            echo "<script>alert('Password salah!');</script>";
        }
    // }else if(mysqli_num_rows($result_b_1) == 1){
    //     $row = mysqli_fetch_assoc($result_b_1);
    //     if(password_verify($password, $row["password"])){
    //         $query = "SELECT id FROM admins WHERE username='$username'";
    //         $result = mysqli_query($conn, $query) or die(mysql_error());
    //         $rows = mysqli_fetch_array($result);
    //         if(isset($rows['id']) && $rows['id'] > 0){
    //             $_SESSION["admin"] = true;
    //             header("Location: admin.php?id=");
    //         }
    //         exit;
    //     }else{
    //         echo "<script>alert('Password salah!');</script>";
    //     }
    }else{
        echo "<script>alert('Username atau email tidak terdaftar!');</script>";
    }
}

if(isset($_POST["cari"])){
    $masukan = $_POST["masukan"];
    header("Location: search.php?&cari=$masukan");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="icon" href="images/logo.png" type="image/ico">
    <link rel="stylesheet" type="text/css" href="style/style_login.css">
    <title>Login - Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
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
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_putra">Kamar Kost Putra</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_putri">Kamar Kost Putri</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_campur">Kamar Kost Campur</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_terbaik">Kamar Kost Rating Tinggi</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=kost_termurah">Kamar Kost Termurah</a></li>
                        <li><a class="dropdown-item" href="kost_ketintang.php?&kategori=semua_kost">Semua Kamar Kost</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="about.php">Bantuan</a>
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
                <p class="login-text">Login Form</p>
                <div class="input-group">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="input-group">
                    <button name="login" type="submit" class="btn">Login</button>
                </div>
                <p class="description-text">Belum punya akun? Daftar sebagai <a class ="register-text" href="register_user.php">pencari kos</a> atau sebagai <a class ="register-text" href="register_admin.php">pemilik kos</a></p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
</body>
</html>