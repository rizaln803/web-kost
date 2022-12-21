<?php

session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];
$rate = $_GET["rate"];

if(rating($id, $rate) > 0){
    echo "<script>alert('Penilaian diberikan.');
            document.location.href = 'rent_list.php';</script>";
}else{
    echo "<script>alert('Penilaian gagal.');
            document.location.href = 'rent_list.php';</script>";
}

?>