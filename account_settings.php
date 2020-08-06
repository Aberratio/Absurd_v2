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
      <div class="col-sm-10 col-lg-6 col-xl-5 mx-auto">
        <div class="container mt-5">
          <form action="" method="post" class="settings_form pt-3" enctype="multipart/form-data">
            <div class="card">
              <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                <?php echo $infos->update_profile; ?>
              </h4>

              <a href='menu.php' class='text-decoration-none ml-2 mb-2'>
                <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
              </a>

              <div class="option_container mx-3 mt-2">
                <div class="row">
                  <?php
                  $user_id = $_SESSION['id'];
                  $get_user = "select * from bridgeplayers where id='$user_id'";
                  $run_user = mysqli_query($con, $get_user);
                  $row = mysqli_fetch_array($run_user);

                  $user_name = $row['user'];
                  $user_pass = $row['pass'];
                  $user_email = $row['email'];
                  $profile_picture = $row['profile_picture'];
                  ?>

                  <div class="row col-12 mx-auto">
                    <div class="col-6 pr-2">
                      <a class="btn btn-default text-dark pl-0" style="text-decoration: none;" href="upload.php">
                        <img class="profile_picture" src="<?php echo $profile_picture; ?>">
                      </a>
                    </div>
                    <div class="col-6 my-auto">
                      <a class="btn btn-default text-dark" style="text-decoration: none;font-size: 15px;" href="upload.php">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <?php echo $infos->click_to_change_profile_picture; ?>
                      </a>
                    </div>
                  </div>
                  <div class="row col-12 mt-4 mx-auto">
                    <div class="col-6">
                      <div class="mr-3 mb-4" style="font-weight: bold; ">
                        <?php echo $infos->rename; ?>
                      </div>
                      <div class="mb-4" style="font-weight: bold;">
                        <?php echo $infos->change_email; ?>
                      </div>
                      <div style="font-weight: bold; margin-right: 20px;">
                        <?php echo $infos->language; ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div>
                        <input class="form-control ml-2 mb-2" type="text" name="u_name" required="required" value="<?php echo $user_name; ?>">
                      </div>
                      <div>
                        <input class="form-control  ml-2" type="email" name="u_email" required="required" value="<?php echo $user_email; ?>">
                      </div>

                      <div>
                        <select class="form-control mt-3 mb-3 ml-2" name="language">
                          <option value="1">English</option>
                          <option selected="" value="0">Polski</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="text-right"><a class="btn btn-default text-dark " style="text-decoration: none;font-size: 15px;" href="change_password.php"><?php echo $infos->change_password; ?></a>
                    </div>
                  </div>
                  <div class = "col-12">
                  <?php

                    if (isset($_POST['update'])){
                      $user_id = $_SESSION['id'];
                      $get_user = "select * from bridgeplayers where id='$user_id'";
                      $run_user = mysqli_query($con, $get_user);
                      $row = mysqli_fetch_array($run_user);

                      $primary_user_name = $row['user'];
                      $primary_user_email = $row['email'];

                      $user_name = htmlentities($_POST['u_name']);
                      $user_email = htmlentities($_POST['u_email']);
                      $language = htmlentities($_POST['language']);
                      $is_good=true;

                      try {
                        $db_connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($db_connection->connect_errno != 0) {
                            throw new Exception(mysqli_connect_errno());
                        } else {
                          if($primary_user_email!=$user_email){
                            //checking email in data base
                            $result = $db_connection->query("SELECT id FROM bridgeplayers WHERE email='$user_email'");

                            if (!$result) {
                                throw new Exception(($db_connection->error));
                            }
                            $same_email_counter = $result->num_rows;
                            if ($same_email_counter > 0) {
                                $is_good = false;

                                $_SESSION['error_email'] = "Email zajęty!";
                                echo "
                                      <div class='alert alert-danger'>
                                        <strong>" . $infos->user_email_in_use . "</strong> 
                                      </div>
                                    ";
                            }
                              //checking email
                              $save_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

                              if ((filter_var($save_email, FILTER_VALIDATE_EMAIL) == false) || ($save_email != $user_email)) {
                                  $is_good = false;
                                  echo "
                                        <div class='alert alert-danger'>
                                          <strong>" . $infos->user_email_incorrect  . "</strong> 
                                        </div>
                                      ";
                              }
                          }
                          if($primary_user_name!=$user_name){
                            //checking username in data base
                            $result = $db_connection->query("SELECT id FROM bridgeplayers WHERE user='$user_name'");
                            
                            if (!$result) {
                              throw new Exception(($db_connection->error));
                            }
                            $same_user_counter = $result->num_rows;
                            if ($same_user_counter > 0) {
                              $is_good = false;
                              $_SESSION['error_user'] = "Login zajęty!";
                              echo "
                                      <div class='alert alert-danger'>
                                        <strong>" . $infos->user_name_in_use  . "</strong> 
                                      </div>
                                    ";
                            }
                              
                              if ((strlen($user_name) < 3) || (strlen($user_name) > 20)) {
                                  $is_good = false;
                                  echo "
                                      <div class='alert alert-danger'>
                                        <strong>" . $infos->user_name_incorrect_length  . "</strong> 
                                      </div>
                                    ";
                              }

                              if (ctype_alnum($user_name) == false) {
                                  $is_good = false;
                                  echo "
                                      <div class='alert alert-danger'>
                                        <strong>" . $infos->user_name_incorrect_signs  . "</strong> 
                                      </div>
                                    ";
                              }
                          }
                      
                          if($is_good){
                            $update = "update bridgeplayers set user='$user_name', email='$user_email', language='$language' where id='$user_id'";
                            $_SESSION['user'] = $user_name;
                            $_SESSION['email'] = $user_email;
                            $_SESSION['language'] = $language;

                            $run = mysqli_query($con, $update);
                            if($primary_user_email!=$user_email){
                              echo "
                                        <div class='alert alert-succes'>
                                          <strong>" . $infos->user_email_changed . "</strong> 
                                        </div>
                                      ";
                            }
                            if($primary_user_name!=$user_name){
      
                              echo "
                              <div class='alert alert-success'>
                              <strong>" . $infos->user_name_changed . "</strong> 
                              </div>
                              ";        
                            }

                            if ($run) {
                              echo "<script>window.open('account_settings.php','_self')</script>";
                            }
                          }
                          
                            $db_connection->close();
                        }
                      } catch (Exception $e) {
                        echo '<span style=color:red;">Błąd serwera!</span>';
                      }
                      
                    }
                    ?>
                  </div>

            
                </div>
                <div class="col-sm-2">
                </div>

              </div>
              <div class="mb-3 mx-3">
                <button class="btn btn-secondary mt-3 btn-block" type="submit" name="update"> <?php echo $infos->update; ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- FOOTER -->

      <div class="navbar fixed-bottom justify-content-center align-content-center" id="main-footer">
        <div class="footer-container">
          <p class="copyright">
            Copyright &copy; 2020 by
            <a href="https://www.facebook.com/joanna.gertrud.kokot/" target="_blank">Aberratio</a>. All Rights Reserved
          </p>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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