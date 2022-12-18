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

    $room_name = htmlspecialchars($data["room_name"]);
    $price = htmlspecialchars($data["price"]);
    $description = htmlspecialchars($data["description"]);
    $stock = $data["stock"];
    $ids = $data["id"];

    $photo = upload();
    if(!$photo){
        return false;
    }

    $query = "INSERT INTO kosts 
                VALUES
            ('', '$room_name', '$photo', '$price', '$description', '$stock','$ids')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $nama_file = $_FILES['photo']['name'];
    $size_file = $_FILES['photo']['size'];
    $error_file = $_FILES['photo']['error'];
    $tmp_file = $_FILES['photo']['tmp_name'];

    if($error_file === 4){
        echo "<script>
            alert('Pilih gambar terlebih dahulu.');
        </script";
        return false;
    }

    $ekstensi_file_terima = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if(!in_array($ekstensi_file, $ekstensi_file_terima)){
        echo "<script>
            alert('Pilih gambar dengan format jpg/jpeg/png.');
        </script";
        return false;
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;

    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    return $nama_file_baru;
}

function registrasi_a($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $name = ($data["name"]);
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

    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$name', '$phone', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

function registrasi_b($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $name = ($data["name"]);
    $type = ($data["type"]);
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

    mysqli_query($conn, "INSERT INTO admins VALUES('', '$username', '$name', '$type', '$address', '$phone', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;

    mysqli_query($conn, "DELETE FROM kosts WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $room_name = htmlspecialchars($data["room_name"]);
    $price = htmlspecialchars($data["price"]);
    $description = htmlspecialchars($data["description"]);
    $stock = $data["stock"];
    $ids = $data["id"];
    
    if($_FILES['photo']['error'] === 4){
        $photo = $data["gambar_lama"];
    }else{
        $photo = upload();
    }

    $query = "UPDATE kosts SET
                room_name = '$room_name',
                price = '$price',
                photo = '$photo',
                stock = '$stock',
                description = '$description'
            WHERE id = $ids
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function adprofile($data){
    global $conn;

    $name = ($data["name"]);
    $type = ($data["type"]);
    $address = ($data["address"]);
    $phone = ($data["phone"]);
    $ids = $data["id"];

    $query = "UPDATE admins SET
                name = '$name',
                type = '$type',
                address = '$address',
                phone = '$phone'
            WHERE id = $ids
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function usprofile($data){
    global $conn;

    $name = ($data["name"]);
    $phone = ($data["phone"]);
    $ids = $data["id"];

    $query = "UPDATE users SET
                name = '$name',
                phone = '$phone'
            WHERE id = $ids
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($masukan){
    $query = "SELECT * FROM kosts WHERE name LIKE '%$masukan%'";
    return query($query);
}

?>