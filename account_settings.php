<?php
session_start();
include("connect.php");

if (!isset($_SESSION['is_logged'])) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Absurd - Bridge Platform</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top py-1">
  <div class="container">
    <a class="navbar-brand" href="menu.php">
      <img src="img/logo_Asia_rev.png" alt="" width="50" height="50" />
      <h3 class="d-inline align-middle">Absurd</h3>
      <img src="img/logo_Domi_rev.png" alt="" width="50" height="50" />
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <p class="text-light"> Points: <?php echo $_SESSION['player_points']; ?> </p>
        </li>
        <li class="nav-item">
          <img class='profile_picture_nav' src='<?php echo $_SESSION['profile_picture']; ?>'>
          <i style="color:white;"><?php echo $_SESSION['user']; ?></i>
        </li>
        <li class="nav-item">
          <a class="text-decoration-none text-light" href="logout.php">Log Out</a>
        </li>
    </div>
  </div>
</nav>

<body>

  <div class="row">
    <div class="col-sm-2">
    </div>
    <?php
    $user = $_SESSION['email'];
    $get_user = "select * from bridgeplayers where email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['user'];
    $user_pass = $row['pass'];
    $user_email = $row['email'];
    $profile_picture = $row['profile_picture'];
    ?>
    <div class="col-sm-8">
      <h2 style="color: rgb(247, 109, 109); margin-top: 20px; margin-left: 70px;">Ustawienia profilu</h2>
      <form action="" method="post" class="settings_form" enctype="multipart/form-data">
        <table>
          <tr>
            <td style="font-weight: bold; margin-right: 20px;">Zmień nazwę</td>
            <td>
              <input class="form-control" type="text" name="u_name" required="required" value="<?php echo $user_name; ?>" />
            </td>
          </tr>

          <tr>
            <td>
              <img class='profile_picture' src="<?php echo $profile_picture; ?>">
            </td>

            <td><a class="btn btn-default" style="text-decoration: none;font-size: 15px; color: #5dbaf89c;" href="upload.php"><i class="fa fa-user" aria-hidden="true"></i>Zmień zdjęcie profilowe</a></td>
          </tr>

          <tr>
            <td style="font-weight: bold;">Zmień email</td>
            <td>
              <input class="form-control" type="email" name="u_email" required="required" value="<?php echo $user_email; ?>"></td>
          </tr>

          <tr>
            <td style="font-weight: bold;"></td>

            <td><a class="btn btn-default" style="text-decoration: none;font-size: 15px; color: #5dbaf89c;" href="change_password.php"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Zmiana hasła</a></td>
          </tr>

          <tr style="align:center;">
            <td colspan="6">
              <input class="update_button" type="submit" name="update" value="Zaktualizuj" />
            </td>
          </tr>
        </table>
      </form>
      <?php

      if (isset($_POST['update'])) {

        $user_name = htmlentities($_POST['u_name']);
        $email = htmlentities($_POST['u_email']);

        $update = "update bridgeplayers set user='$user_name', email='$email' where email='$user'";

        $run = mysqli_query($con, $update);

        if ($run) {
          echo "<script>window.open('account_settings.php','_self')</script>";
        }
      }

      ?>
    </div>
    <div class="col-sm-2">
    </div>
  </div>

  </main>

  <footer>

  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>

<script>
  function show_password() {
    var x = document.getElementById("mypass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>