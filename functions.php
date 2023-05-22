<?php
$db = mysqli_connect("localhost", "root", "", "phpdasar");

// CRUD 
// -C = create => membuat
// -R = Read => memnampilkan
// -U = Update => mengubah
// -D = Delete => menghapus

// Read
function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
}

// Tambah
function tambah($data)
{
    global $db;
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    // Upload ambar dulu
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES 
        ('','$nama','$nrp','$email','$jurusan','$gambar')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// upload
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $eror = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Validasi upload

    // Cek user upload
    if ($eror == 4) {
        echo "<script>
                alert('Pilih data terlebih dahulu !');
                document.location.href ='tambah.php' 
            </script>
            ";
        return false;
    }

    // Cek exstensi file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Pastikan yang di upload adalah gambar !');
            </script>
            ";
    }

    // Cek ukuran gambar 
    if ($ukuranFile > 2000000) {
        echo "<script>
                alert('Ukuran gambar tidak boleh dari 2MB !');
            </script>
            ";
    }

    // Lolos pengecekan
    // generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

// Hapus
function hapus($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id;");
    return mysqli_affected_rows($db);
}

// Update data
function ubah($data)
{
    global $db;
    $id = $data["id"];
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gamabLama = htmlspecialchars($data["gambarlama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gamabLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE mahasiswa SET 
            nrp = '$nrp',
            nama = '$nama',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar' 
            WHERE id = $id
    ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function cari($keyword)
{

    $query = ("SELECT * FROM mahasiswa 
                WHERE
                nrp LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                email LIKE '%$keyword%'OR
                jurusan LIKE '%$keyword%'
    ");
    return query($query);
}

// Sign up 
function signup($data)
{
    global $db;

    $username =  strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data['password']);
    $password2 = mysqli_real_escape_string($db, $data['password2']);

    // Validasi username
    $valuser =  mysqli_query($db, "SELECT username FROM user WHERE 
                username = '$username'
    ");
    if (mysqli_fetch_assoc($valuser)) {
        echo "<script>
        alert('Username Yang anda masukan sudah pernah di digunakan !')
        </script>
    ";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
        alert('Ada kesalahan saat memasukan konfirmasi password !')
        </script>
    ";
        return false;
    }
    // engkripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);
    //  Tambahkan user ke database
    mysqli_query($db, "INSERT INTO user VALUES 
                ('','$username','$password')
    ");
    return mysqli_affected_rows($db);
}
