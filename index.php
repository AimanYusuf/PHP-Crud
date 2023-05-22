<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log-in.php");
    exit;
}
// koneksi database
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ");

//jika ingin mengurutkan bedasarkan adi paling besar 
// ORDER BY id DESC 
//jika ingin mengurutkan bedasarkan adi paling kecil
// ORDER BY id ASC
// UNTUK MENAMPILKAN KEY KHUSUS
// WHERE nrp = '090243438';

if (isset($_POST["cari"])) {

    $mahasiswa = cari($_POST["keyword"]);
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        * {
            font-family: "poppins", sans-serif;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .container a {
            color: black;
            text-decoration: none;
        }
        button {
            background-color: blue;
            color: white;
        }
        table {
            width: 90%;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="index.php"><h1>Daftar Mahasiswa</h1></a>
        <form action="" method="post">
            <input type="text" name="keyword" placeholder="Cari..!" autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <div class="akun">
            <a href="sign-up.php"><button>Sign up</button></a>
            <a href="logout.php"><button>Log out</button></a>
        </div>
    </div>
    <table cellpadding="10" cellspacing="0">
        <tr>
            <td><a href="tambah.php">Tambah data</a></td>
        </tr>
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td style="text-align: center;"><?php echo $i ?></td>
                <td>
                    <a href="update.php?id=<?php echo $mhs["id"] ?>">Ubah</a> |
                    <a href=" delete.php?id=<?php echo $mhs["id"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data terpilih ?')" ;>Hapus</a>
                </td>
                <td>
                    <img src=" img/<?php echo $mhs["gambar"] ?>" width="70">
                </td>
                <td><?php echo $mhs["nrp"] ?></td>
                <td><?php echo $mhs["nama"] ?></td>
                <td><?php echo $mhs["email"] ?></td>
                <td><?php echo $mhs["jurusan"] ?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </table>



</body>

</html>