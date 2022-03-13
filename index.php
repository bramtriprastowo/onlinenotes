<?php
session_start();

require 'functions.php';

if(isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  //cek ada username yang sesuai atau tidak
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if(mysqli_num_rows($result) === 1){
    //cek password
    $row = mysqli_fetch_assoc($result);
    
    if(password_verify($password, $row["password"])){

      //set session
      $_SESSION["login"] = true;

      //set username
      $_SESSION["username"] = $username;
      header("Location: dashboard.php");
      exit;
    }

  }

  $error = true;

}

if(isset($_SESSION["login"])){
  header("Location: dashboard.php");
  exit;
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
    <title>Online Notes | Login</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center margin-top">
        <div class="col col1">
          <p class="p-title">ONLINE NOTES</p>
          <br>
          <img src="images/notes.png" alt="online notes" class="img-main">
          <br><br><br>
          <p class="p-subtitle">Open your notes everywhere and anywhere.</p>
        </div>
        <div class="col">
          <div class="main-login">  
          <h3>Login</h3>

                <?php if(isset($error)) : ?>
                <p class="error-p">Username atau Password Salah!</p>
                <?php endif; ?>

                <form class="" action="" method="post">
                  <br>
                  <table>
                    <tr>
                      <td>
                        <input type="text" name="username" autocomplete="off" placeholder="Username">
                      </td>
                    </tr>
                    <tr>
                      <td>
                      <input type="password" name="password" autocomplete="off" placeholder="Password">
                      </td>
                    </tr>                 
                    <tr>
                      <td><br>
                      <button type="submit" name="login" class="btn btn-primary btn-login">Login</button>
                      </td>
                    </tr>                 
                  </table>
                  <br>
                </form>
                </div>
                <br>
                <div class="main-login">
                <span>Belum Punya Akun? <a href="registration.php" class="span-daftar">Daftar</a></span>
                </div>
      </div>
    <br>
    </div>
    <div>
  </body>
</html>