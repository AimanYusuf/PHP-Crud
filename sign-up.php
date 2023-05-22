<?php
//Tombol regester sudah di tekan 

require 'functions.php';
if (isset($_POST["signup"])) {

  if (signup($_POST) > 0) {
    echo "<script>
        alert('Anda telah berhasil regetrasi !')
        document.location.href ='log-in.php'
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
  <title>Admin - sign up</title>
  <style>
    * {
      font-family: "poppins", sans-serif;
    }
  </style>
</head>

<body>
  <h1>Regestrasi dulu diri anda saebagai admin !</h1>
  <table>
    <form action="" method="post">
      <tr>
        <td><label for="username">username </label></td>
        <td>: <input type="text" name="username" id="Username" required maxlength="9"></td>
      </tr>
      <tr>
        <td><label for="password">Password </label></td>
        <td>: <input type="password" name="password" id="password" required></td>
      </tr>
      <tr>
        <td><label for="password2">Konfirmasi Password </label></td>
        <td>: <input type="password" name="password2" id="password2" required></td>
      </tr>
      <td><button type="submit" name="signup" required>SIgn Up</button></td>
      </tr>
    </form>
  </table>


</body>

</html>