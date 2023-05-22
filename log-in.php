<?php
session_start();
require 'functions.php';
if (isset($_COOKIE['id']) && isset($_COOKIE['username'])) {
  $id = $_COOKIE['id'];
  $user = $_COOKIE['username'];

  $result = mysqli_query($db, "SELECT username FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  if ($user === hash('sha256', $row['username'])) {
    $_SESSION["login"] = true;
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}


if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];
  $result = mysqli_query($db, ("SELECT * FROM  user WHERE username = '$username'"));

  // cek username
  if (mysqli_num_rows($result) === 1) {
    //cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

      $_SESSION["login"] = true;

      if (isset($_POST['remember'])) {
        setcookie('id', $row['id'], time() + 60);
        setcookie('username', hash('sha256', $row['username']), time() + 60);
      }
      echo "<script>
                alert('Selamat anda telah berhasil Login !')
                document.location.href ='index.php' 
            </script>
            ";
      exit;
    }
  }
  $eror = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin -log in </title>
  <style>
    * {
      font-family: "poppins", sans-serif;
    }
  </style>
</head>

<body>
  <h1>
    Halaman Log in
  </h1>
  <?php if (isset($eror)) : ?>
    <p style="color:red;">Ada kesalahan saat memasukan username/Password</p>
  <?php endif; ?>
  <table>
    <form action="" method="post">

      <tr>
        <td><Label for="username">User Name</Label></td>
        <td>:<input type="text" name="username" id="username" required></td>
      </tr>
      <tr>
        <td><Label for="password">Password</Label></td>
        <td>:<input type="password" name="password" id="password" required></td>
      </tr>
      <tr>
        <td><input type="checkbox" name="remember">Remember me</td>
      </tr>
      <tr>
        <td><button type="submit" name="login">Log in</button>
        </td>
        <td><a href="sign-up.php">Belum Memiliki Akun ?</a></td>
      </tr>

    </form>
  </table>




</body>

</html>