<?php

session_start();

if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

if(isset($_SESSION["admin"])){
    header("Location: admin.php");
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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">

    <link rel="stylesheet" type="text/css" href="style/style_login.css">
    <title>Login : Kost Ketintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md fixed-top" style="border-bottom: 2px solid #e7e7e7; background: rgba(255, 255, 255, 0.95);">
            <div class="container">
                <a href="" class="navbar-brand"><img src="images/logo.png" style="height: 50px" alt=""></a>
                <form class="header-center ms-3 me-auto d-flex" action="">
                    <input class="form-control" type="text" placeholder="Cari Kost...">
                    <button class="btn" type="button">Cari</i></button>
                </form>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="header-right ms-auto navbar-nav">
                    <li class="nav-item ms-4">
                        <a class="nav-link" href="">Beranda</a>
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
                <p class="description-text">Belum punya akun? Daftar sebagai <a class ="register-text" href="register_a.php">pencari kos</a> atau sebagai <a class ="register-text" href="register_b.php">pemilik kos</a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>