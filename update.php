<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log-in.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Pengubahan data telah berhasil !')
                document.location.href ='index.php' 
            </script>
            ";
    } else {
        echo "<script>
                alert('Pengubahan data Gagal !')
            </script>
            ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>
<style>
    * {
        font-family: "poppins", sans-serif;
    }
</style>

<body>
    <h1>Update data Mahasiswa</h1>
    <table>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $mhs["id"] ?>">
            <input type="hidden" name="gambarlama" value="<?= $mhs["gambar"] ?>">
            <tr>
                <td><label for=" nrp">NRP </label></td>
                <td>: <input type="text" name="nrp" id="nrp" value="<?= $mhs["nrp"] ?>" required maxlength="9"></td>
            </tr>
            <tr>
                <td><label for="nama">Nama </label></td>
                <td>: <input type="text" name="nama" id="nama" value="<?= $mhs["nama"] ?>" required></td>
            </tr>
            <tr>
                <td><label for="email">Email </label></td>
                <td>: <input type="email" name="email" id="email" value="<?= $mhs["email"] ?>" required></td>
            </tr>
            <tr>
                <td><label for="jurusan">jurusan </label></td>
                <td>: <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"] ?>" required></td>
            </tr>
            <tr>
                <td><label for="gambar">Gambar </label></td>
                <td>: <img src="img/<?= $mhs['gambar'] ?>" alt="" width="50px"><br><input type="file" name="gambar" id="gambar"></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit" required>Update</button></td>
            </tr>
        </form>
    </table>
    <a href="index.php"><button>Kembali <-- </button></a>
</body>

</html>