<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: log-in.php");
    exit;
}
require 'functions.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>
            alert('Penghapusan data telah berhasil !')
            document.location.href ='index.php' 
        </script>
        ";
} else {
    echo "<script>
            alert('Penghapusan data Gagal !')
        </script>
        ";
}
