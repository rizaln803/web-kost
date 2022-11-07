<?php

$conn = mysqli_connect("localhost", "root", "", "web_kost");

function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data){
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $description = htmlspecialchars($data["description"]);
    $ids = $data["id"];

    $query = "INSERT INTO kosts 
                VALUES
            ('', '$name', '', '$price', '$description', '$ids')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function registrasi_a($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $cpassword = mysqli_real_escape_string($conn, $data["cpassword"]);

    $result_a = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $result_b = mysqli_query($conn, "SELECT username FROM admins WHERE username = '$username'");
    if(mysqli_fetch_assoc($result_a) || mysqli_fetch_assoc($result_b)){
        echo "<script>alert('Username sudah digunakan!');</script>";
        return false;
    }

    $result_a = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    $result_b = mysqli_query($conn, "SELECT email FROM admins WHERE email = '$email'");
    if(mysqli_fetch_assoc($result_a) || mysqli_fetch_assoc($result_b)){
        echo "<script>alert('Email sudah digunakan!');</script>";
        return false;
    }

    if($password !== $cpassword){
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

function registrasi_b($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $name = ($data["name"]);
    $address = ($data["address"]);
    $phone = ($data["phone"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $cpassword = mysqli_real_escape_string($conn, $data["cpassword"]);

    $result_a = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $result_b = mysqli_query($conn, "SELECT username FROM admins WHERE username = '$username'");
    if(mysqli_fetch_assoc($result_a) || mysqli_fetch_assoc($result_b)){
        echo "<script>alert('Username sudah digunakan!');</script>";
        return false;
    }

    $result_a = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    $result_b = mysqli_query($conn, "SELECT email FROM admins WHERE email = '$email'");
    if(mysqli_fetch_assoc($result_a) || mysqli_fetch_assoc($result_b)){
        echo "<script>alert('Email sudah digunakan!');</script>";
        return false;
    }

    if($password !== $cpassword){
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO admins VALUES('', '$username', '$name', '$address', '$phone', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM kosts WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $description = htmlspecialchars($data["description"]);
    $ids = $data["ids"];

    $query = "UPDATE kosts SET
                name = '$name',
                price = '$price',
                description = '$description'
            WHERE id = $ids
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>