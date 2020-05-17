<?php

include("connect.php");
require_once "JWT/handleJWT.php";

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
<!-- MENU -->

<body>
  <div class="site-container">
    <div class="row mb-5 mt-5">
      <!-- PLAYER PANEL-->
      <div class="col-sm-10 col-lg-6 mx-auto">
        <div class="container mt-5">
          <div class="card">
            <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
              Settings
            </h4>
            <div class="option_container mx-3 mt-2">
              <div class="option">
                <div class="row">
                  <div class="col-sm-2">
                  </div>
                  <?php
                  $user = $array['email'];
                  $get_user = "select * from bridgeplayers where email='$user'";
                  $run_user = mysqli_query($con, $get_user);
                  $row = mysqli_fetch_array($run_user);

                  $user_name = $row['user'];
                  $user_pass = $row['pass'];
                  $user_email = $row['email'];
                  $profile_picture = $row['profile_picture'];
                  ?>
                  <div class="col-sm-8">
                    <form action="" method="post" class="settings_form pt-3" enctype="multipart/form-data">
                      <table class="mb-4">
                        <tr>
                          <td class="mr-3" style="font-weight: bold; margin-right: 20px;">
                            Rename</td>
                          <td>
                            <input class="form-control" type="text" name="u_name" required="required" value="<?php echo $user_name; ?>" />
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <img class='profile_picture' src="<?php echo $profile_picture; ?>">
                          </td>

                          <td><a class="btn btn-default text-dark" style="text-decoration: none;font-size: 15px;" href="upload.php"><i class="fa fa-user mr-2" aria-hidden="true"></i>Change your profile photo</a></td>
                        </tr>

                        <tr>
                          <td style="font-weight: bold;">Change email</td>
                          <td>
                            <input class="form-control" type="email" name="u_email" required="required" value="<?php echo $user_email; ?>"></td>
                        </tr>

                    <?php

                    if (isset($_POST['update'])) {

                      $user_name = htmlentities($_POST['u_name']);
                      $email = htmlentities($_POST['u_email']);
                      $update = "update bridgeplayers set user='$user_name', email='$email' where email='$user'";

                      $run = mysqli_query($con, $update);

                      if ($run) {
                          $payload = array(
                              "exp" => time() + 3600,
                              "id" => $array['id'],
                              "user" => $user_name,
                              "email" => $email,
                              "cezar" => $array['cezar'],
                              "profile_picture" => $array['profile_picture'],
                              "role" => $array['role'],
                              "player_points" => $array['player_points'],
                          );

                          $JWT = createJWT($payload);
                          setcookie("token", $JWT, [
                              'expires' => time() + 86400,
                              'path' => '/',
                              'secure' => false,
                              'samesite' => 'Strict',
                              'httponly' => true
                          ]);
                        echo "<script>window.open('account_settings.php','_self')</script>";
                      }
                    }

                    ?>
                          <tr>
                              <td colspan="6">
                                  <input class="btn btn-secondary mt-3 btn-block" type="submit" name="update" value="Update" />
                              </td>
                          </tr>
                      </table>
                    </form>
                      <tr>
                          <td style="font-weight: bold;"></td>

                          <td><a class="btn btn-default text-dark" style="text-decoration: none;font-size: 15px;" href="change_password.php"><i class="fa fa-key fa-fw mr-2" aria-hidden="true"></i>Password change</a></td>
                      </tr>
                  </div>
                  <div class="col-sm-2">
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <!-- FOOTER -->

    <div class="navbar fixed-bottom justify-content-center align-content-center" id="main-footer">
      <div class="footer-container">
        <p class="copyright">
          Copyright &copy; 2020 by
          <a href="https://www.facebook.com/joanna.kokot.37" target="_blank">Aberratio</a>. All Rights Reserved
        </p>
      </div>
    </div>
  </div>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
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