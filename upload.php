<?php
session_start();
include("connect.php");
//include("header.php");
?>
<?php

if (!isset($_SESSION['is_logged'])) {

    header("location: menu.php");
} else { ?>
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

        <main>

            <?php
            $user = $_SESSION['email'];
            $get_user = "select * from bridgeplayers where email='$user'";
            $run_user = mysqli_query($con, $get_user);
            $row = mysqli_fetch_array($run_user);

            $user_name = $row['user'];
            $user_profile = $row['profile_picture'];
            echo "
		
  <div class='row'>
    <div class='col-sm-2'>
    </div>
    <div class='col-sm-8'>
    <h2 style='color: rgb(247, 109, 109); margin-top: 30px;'>$user_name</h2>
      <img class='profile_picture' src='$user_profile'>
			
      <form method='post' enctype='multipart/form-data' style='margin-top: 30px;'>
      
      <div id='update_profile' >
        <input type='file' name='u_image' size='60' />
      </div>
          <div style='margin-top:20px;'>  <button id='button_profile' class='update_button' name='update'>Aktualizuj</button>
     </div>
            </form>
      </div>
		</div><br><br>
		";
            ?>

            <?php

            if (isset($_POST['update'])) {

                $u_image = $_FILES['u_image']['name'];
                $image_tmp = $_FILES['u_image']['tmp_name'];
                $random_number = rand(1, 100);

                if ($u_image == '') {
                    echo "<script>alert('Wybierz zdjęcie profilowe')</script>";
                    echo "<script>window.open('upload.php','_self')</script>";
                    exit();
                } else {

                    move_uploaded_file($image_tmp, "img/$u_image.$random_number");


                    $update = "update bridgeplayers set profile_picture='img/$u_image.$random_number' where email='$user'";

                    $run = mysqli_query($con, $update);

                    if ($run) {

                        echo "<script>alert('Zaktualizowano profil!')</script>";
                        echo "<script>window.open('upload.php','_self')</script>";
                    }
                }
            }


            ?>

        </main>

        <footer>

        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
<?php } ?>