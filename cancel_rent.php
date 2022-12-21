<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

if(batal($id) > 0){
    echo "<script>alert('Transaksi dibatalkan.');
            document.location.href = 'rent_list.php';</script>";
}else{
    echo "<script>alert('Transaksi gagal dibatalkan.');
            document.location.href = 'rent_list.php';</script>";
}

?>