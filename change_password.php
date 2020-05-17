<!DOCTYPE html>
<?php
session_start();
include("connect.php");
require_once "JWT/handleJWT.php";

?>
<?php
if (!isset($_COOKIE["token"])) {
  header('Location: index.php');
  exit();
}
$token = $_COOKIE["token"];
$payload = validateJWTAndReturnPayload($token);
$array = json_decode(json_encode($payload), true);
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
          <p class="text-light"> Points: <?php echo $array['player_points']; ?> </p>
        </li>
        <li class="nav-item">
          <img class='profile_picture_nav' src='<?php echo $array['profile_picture']; ?>'>
          <i style="color:white;"><?php echo $array['user']; ?></i>
        </li>
        <li class="nav-item">
          <a class="text-decoration-none text-light" href="logout.php">Log Out</a>
        </li>
    </div>
  </div>
</nav>

<body>

  <main>
    <div class="row">
      <div class="col-sm-2">
      </div>
      <?php
      $user = $array['email'];
      $get_user = "select * from bridgeplayers where email='$user'";
      $run_user = mysqli_query($con, $get_user);
      $row = mysqli_fetch_array($run_user);

      $user_pass = $row['pass'];
      ?>
      <div class="col-sm-8">
        <h2 style="color: rgb(247, 109, 109); margin-top: 20px; margin-left: 70px;">Zmień hasło</h2>
        <form action="" method="post" class="settings_form" enctype="multipart/form-data">
          <table>

            <tr>
              <td style="font-weight: bold;">Bieżące hasło</td>
              <td>
                <input class="form-control" type="password" name="current_pass" id="mypass" required="required" placeholder="Bieżące hasło" />
              </td>
            </tr>

            <tr>
              <td style="font-weight: bold;">Nowe hasło</td>
              <td>
                <input class="form-control" type="password" name="u_pass1" id="mypass" required="required" placeholder="Nowe hasło" />
              </td>
            </tr>

            <tr>
              <td style="font-weight: bold;">Powtórz nowe hasło</td>
              <td>
                <input class="form-control" type="password" name="u_pass2" id="mypass" required="required" placeholder="Powtórz nowe hasło" />
              </td>
            </tr>

            <tr align="center">
              <td colspan="6">
                <input class="update_button" type="submit" name="update" value="Zaktualizuj" />
              </td>
            </tr>
          </table>
        </form>


        <?php
        if (isset($_POST['change'])) {
          $c_pass = $_POST['current_pass'];
          $pass1 = $_POST['u_pass1'];
          $pass2 = $_POST['u_pass2'];

          $user = $array['email'];
          $get_pass = "select * from bridgeplayers where email='$user'";
          $run_pass = mysqli_query($con, $get_pass);
          $row = mysqli_fetch_array($run_pass);

          $user_password = $row['pass'];

          if (!password_verify($c_pass, $user_password)) {
            echo "
                  <div class='alert alert-danger'>
                    <strong>Your old password didn't match </strong> 
                  </div>
                ";
          }

          if ($pass1 != $pass2) {
            echo "
                  <div class='alert alert-danger'>
                    <strong>Your new password did't match with each other</strong> 
                  </div>
                ";
          }
          if ((strlen($pass1) < 8) || (strlen($pass1) > 20)) {
            echo "
                  <div class='alert alert-danger'>
                    <strong>Use 9 to 19 characters</strong> 
                  </div>
                ";
          }

          if ($pass1 == $pass2 and password_verify($c_pass, $user_password)) {
            $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
            $update_pass = mysqli_query($con, "UPDATE bridgeplayers SET pass='$hashed_password' WHERE email='$user'");
            echo "
                  <div class='alert alert-danger'>
                    <strong>Your Password is changed</strong> 
                  </div>
                ";
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
</script>