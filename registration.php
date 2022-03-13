<?php
  session_start();
  require 'functions.php';

  if(isset($_SESSION["login"])){
    header("Location: dashboard.php");
    exit;
  }

  if(isset($_POST["register"])){
    if(registrasi($_POST) > 0){
      echo '<script>
            alert("Username berhasil ditambahkan!");
            window.location.href="index.php";
            </script>';
      exit;
    } else {
      echo mysqli_error($conn);
    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Online Store | Registrasi</title>
  </head>
  <body>
  <div class="container">
    <div class="row justify-content-center margin-top">
      <p class="p-title">ONLINE NOTES</p>
    </div>
    <div class="row justify-content-center margin-top">
      <div class="main-login">
        <h3>Registrasi</h3>
    <form class="" action="" method="post">
      <table>
        <tr>
          <td><br><input type="text" name="username" autocomplete="off" placeholder="Username"></td>
        </tr>
        <tr>
          <td><input type="password" name="password" autocomplete="off" placeholder="Password"></td>
        </tr>
        <tr>
          <td><input type="password" name="password2" autocomplete="off" placeholder="Konfirmasi Password"></td>
        </tr>
        <tr>
          <td><br><button type="submit" name="register" class="btn btn-primary btn-login">Daftar</td>
        </tr>
      </table>
    </form>
    </div>
    </div>
    <br>
    <div class="row justify-content-center">
      <div class="main-login">
        <span>Sudah Punya Akun? <a href="index.php" class="span-daftar">Log In</a></span>
      </div>
    </div>
    </div> 

  </body>
</html>
