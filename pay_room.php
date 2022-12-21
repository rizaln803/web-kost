<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

if(bayar($id) > 0){
    echo "<script>alert('Transaksi berhasil.');
            document.location.href = 'transaction.php?&id=$id';</script>";
}else{
    echo "<script>alert('Transaksi gagal.');
            document.location.href = 'rent_list.php';</script>";
}

?>