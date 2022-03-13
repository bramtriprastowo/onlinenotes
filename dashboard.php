<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
  }

include_once("functions.php");

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    if(mysqli_query($conn, "DELETE FROM notes WHERE id_content = $id_to_delete")){

?>
        <!-- Jika berhasil menghapus -->
        <script type="text/javascript">
            window.location.href = 'dashboard.php';
        </script>

<?php
    }
        //jika gagal menghapus
        echo "query_error: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <title>Online Notes | Dashboard</title>
</head>
<body>

<?php
    $username = $_SESSION["username"];

    include_once("functions.php");
    $contents = mysqli_query($conn, "SELECT * FROM users JOIN notes ON users.id = notes.id_username");

    $ids = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    while($id = mysqli_fetch_array($ids)){
        $id_username = $id['id'];
    }

    $user_contents = mysqli_query($conn, "SELECT id_content, content FROM users JOIN notes ON users.id = notes.id_username
                        WHERE username = '$username'");

    while($user_content = mysqli_fetch_array($user_contents)){
        $id_content = $user_content['id_content'];
        $content_i = $user_content['content'];
    }
?>

    <div class="container">
        <div class="row">
            <div class="col">
                <p class="p-title">ONLINE NOTES</p>
            </div>
            <div class="col">
                <div class="dropdown text-right">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?=$_SESSION["username"];?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    <br> <br>
        <h5>Daftar Notes</h5>
    <br>

        <?php
            while($content = mysqli_fetch_array($contents)){
                if($content['username'] == $_SESSION["username"]){ 
                    echo "
                    <div class='row parents-notes-content'>
                        <div class='col-md notes-content'>
                        <table class='table-content'>
                            <tr>
                            <td class='td-1 border-bot'>
                                <span>".$content['content']."</span>
                            </td>
                            <td class='td-2 border-bot'>
                                <form action='' method='post'>
                                    <input type='hidden' name='id_to_delete' value='".$content['id_content']."'>
                                    <input type='submit' name='delete' value='Hapus' class='btn btn-danger btn-dashboard'>
                                </form>
                            </td>
                            </tr>
                        </table>
                        </div>
                    </div>";      
                }
            }
        ?>
        <br><br>
        <div class="row">
            <div class='col-md'>
                <form action="" method="post" name="form">
                <table class="table-content">
                    <tr>
                        <td class="td-1">
                            <textarea class="form-control" name="content" maxlength="900" rows="2" cols="120" autocomplete="off" placeholder="Note baru ..."></textarea>
                        </td>
                        <td class="td-2">
                            <input type="submit" class="btn btn-primary btn-dashboard" name="submit" value="Tambah">
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
        </div>
</body>
</html>

<?php
  if (isset($_POST['submit'])){
    $id_username;
    $content_i = $_POST['content'];
    
    $insert = mysqli_query($conn, "INSERT INTO `notes`(`id_username`, `content`)
                VALUES('$id_username', '$content_i'); ");

?>
  <script>
      window.location.href='dashboard.php';
  </script>

<?php
    exit;
  }
?>