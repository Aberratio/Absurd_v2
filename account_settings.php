<?php
session_start();
include("connect.php");

if ($_SESSION['language'] == 1) {
  include("lang/lang_eng.php");
} else {
  include("lang/lang_pl.php");
}

$infos = new Infos();

if (!isset($_SESSION['is_logged'])) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<!-- MENU -->

<body>
  <div class="site-container">
    <div class="row mb-5 mt-5">
      <!-- PLAYER PANEL-->
      <div class="col-sm-10 col-lg-6 mx-auto">
        <div class="container mt-5">
          <div class="card">
            <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
              <?php echo $infos->update_profile; ?>
            </h4>
            <div class="option_container mx-3 mt-2">
              <div class="option">
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
                    <form action="" method="post" class="settings_form pt-3" enctype="multipart/form-data">
                      <table class="mb-4">
                        <tr>
                          <td class="mr-3 mb-2" style="font-weight: bold; margin-right: 20px;">
                            <?php echo $infos->rename; ?></td>
                          <td>
                            <input class="form-control ml-2 mb-2" type="text" name="u_name" required="required" value="<?php echo $user_name; ?>" />
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <img class='profile_picture' src="<?php echo $profile_picture; ?>">
                          </td>

                          <td><a class="btn btn-default text-dark" style="text-decoration: none;font-size: 15px;" href="upload.php"><i class="fa fa-user mr-2" aria-hidden="true"></i><?php echo $infos->change_profile_picture; ?></a></td>
                        </tr>


                        <tr>
                          <td style="font-weight: bold; margin-right: 20px;"><?php echo $infos->language; ?></td>
                          <td>
                            <select class="form-control mt-3 mb-3 ml-2" name="language">
                              <option <?php if ($_SESSION['language'] == '1') {
                                        echo ("selected");
                                      } ?> value='1'>English</option>
                              <option <?php if ($_SESSION['language'] == '0') {
                                        echo ("selected");
                                      } ?> value='0'>Polski</option>
                            </select>
                          </td>
                        </tr>

                        <tr>
                          <td style="font-weight: bold;"><?php echo $infos->change_email; ?></td>
                          <td>
                            <input class="form-control  ml-2" type="email" name="u_email" required="required" value="<?php echo $user_email; ?>"></td>
                        </tr>

                        <tr>
                          <td style="font-weight: bold;"></td>

                          <td><a class="btn btn-default text-dark" style="text-decoration: none;font-size: 15px;" href="change_password.php"><i class="fa fa-key fa-fw mr-2" aria-hidden="true"></i><?php echo $infos->change_password; ?></a></td>
                        </tr>

                        <tr>
                          <td colspan="6">
                            <button class="btn btn-secondary mt-3 btn-block" type="submit" name="update"> <?php echo $infos->update; ?> </button>
                          </td>
                        </tr>
                      </table>
                    </form>
                    <?php

                    if (isset($_POST['update'])) {

                      $user_name = htmlentities($_POST['u_name']);
                      $email = htmlentities($_POST['u_email']);
                      $language = htmlentities($_POST['language']);

                      $update = "update bridgeplayers set user='$user_name', email='$email', language='$language' where email='$user'";

                      $_SESSION['language'] = $language;
                      $_SESSION['user'] = $user_name;
                      $_SESSION['email'] = $email;

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