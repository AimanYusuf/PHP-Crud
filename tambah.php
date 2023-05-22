<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log-in.php");
    exit;
}
require 'functions.php';


if (isset($_POST["submit"])) {


    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Pengisian data telah berhasil !')
                document.location.href ='index.php' 
            </script>
            ";
    } else {
        echo "<script>
                alert('Pengisian data Gagal !')
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
    <title>Tambah Data</title>
</head>
<style>
    * {
        font-family: "poppins", sans-serif;
    }
</style>

<body>
    <h1>Tambah data Mahasiswa</h1>
    <table>
        <form action="" method="post" enctype="multipart/form-data">
            <tr>
                <td><label for="nrp">NRP </label></td>
                <td>: <input type="number" name="nrp" id="nrp" required maxlength="9"></td>
            </tr>
            <tr>
                <td><label for="nama">Nama </label></td>
                <td>: <input type="text" name="nama" id="nama" required></td>
            </tr>
            <tr>
                <td><label for="email">Email </label></td>
                <td>: <input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
                <td><label for="jurusan">jurusan </label></td>
                <td>: <input type="text" name="jurusan" id="jurusan" required></td>
            </tr>
            <tr>
                <td><label for="gambar">Gambar </label></td>
                <td>: <input type="file" title="Pilih gambar yang ingin di upload" name="gambar" id="gambar"></td>
            </tr>
            <tr>
                <td><button type="submit" name="submit" required>Tambah</button></td>
            </tr>
        </form>
    </table>
    <a href="index.php"><button>Kembali <-- </button></a>
</body>

</html>