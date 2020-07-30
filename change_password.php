<!DOCTYPE html>
<?php
session_start();
include("connect.php");

if ($_SESSION['language'] == 1) {
  include("lang/lang_eng.php");
} else {
  include("lang/lang_pl.php");
}

$infos = new Infos();

?>
<?php
if (!isset($_SESSION['is_logged'])) {
  header('Location: index.php');
  exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<body>

  <main>
    <div class ="site-container">
      <div class="row my-5">
      <!-- PLAYER PANEL -->
        <div class="row col-12 mt-5 mx-auto">
          <div class=" col-sm-10 col-md-8 col-lg-4 bg-white p-1 rounded mx-auto">
            <form action="" method="post" class="settings_form " enctype="multipart/form-data">
              <h4 class="bg-primary d-block text-center py-2 mt-1 mx-3 rounded text-white text-capitalize"><?php echo $infos->update_password; ?></h4>
              <a href="account_settings.php" class="text-decoration-none ml-2 mb-2">
                <i class="fas fa-long-arrow-alt-left mr-2" aria-hidden="true"></i> <?php echo $infos->back; ?>
              </a>
              <div class="">
                
                <div class ="col-12 option "> 
                  <div class= "mx-auto">         
                    <!-- using data base -->
                      <?php
                        $user = $_SESSION['email'];
                        $get_user = "select * from bridgeplayers where email='$user'";
                        $run_user = mysqli_query($con, $get_user);
                        $row = mysqli_fetch_array($run_user);

                        $user_pass = $row['pass'];
                      ?>
                        <div class="row text-left">
                          <div class= "col-6">
                            <div class="my-4" style="font-weight: bold;"><?php echo $infos->current_password; ?>
                            </div>
                            <div class="my-4" style="font-weight: bold;"><?php echo $infos->new_password; ?>
                            </div>
                            <div class="my-4" style="font-weight: bold;"><?php echo $infos->repeat_new_password; ?>
                            </div>
                          </div>
                          <div class= "col-6">
                            <input class="form-control my-3" type="password" name="current_pass" id="mypass" required="required">
                            <input class="form-control my-3" type="password" name="u_pass1" id="mypass" required="required" >
                            <input class="form-control my-3" type="password" name="u_pass2" id="mypass" required="required" >
                          </div>
                        </div>
                       

                        <div class=" text-right">
                          <a href="forgot_pass.php" class="text-decoration-none ml-2 mb-2"><!-- todo- add an apropriate page -->
                          <i class="fa fa-key fa-fw mr-2" aria-hidden="true"></i><?php echo $infos->forgot_password; ?>
                          </a>
                        </div>

                        <?php
                          if (isset($_POST['change'])) {
                            $c_pass = $_POST['current_pass'];
                            $pass1 = $_POST['u_pass1'];
                            $pass2 = $_POST['u_pass2'];
                            $user = $_SESSION['email'];
                            $get_pass = "select * from bridgeplayers where email='$user'";
                            $run_pass = mysqli_query($con, $get_pass);
                            $row = mysqli_fetch_array($run_pass);

                            $user_password = $row['pass'];

                            if (!password_verify($c_pass, $user_password)) {
                              echo "
                                    <div class='alert alert-danger'>
                                      <strong>" . $infos->old_password_didnt_match . "</strong> 
                                    </div>
                                  ";
                            }

                            if ($pass1 != $pass2) {
                              echo "
                                    <div class='alert alert-danger'>
                                      <strong>" . $infos->new_password_didnt_match . "</strong> 
                                    </div>
                                  ";
                            }
                            if ((strlen($pass1) < 8) || (strlen($pass1) > 20)) {
                              echo "
                                    <div class='alert alert-danger'>
                                      <strong>" . $infos->characters_in_password . "</strong> 
                                    </div>
                                  ";
                            }

                            if ($pass1 == $pass2 and password_verify($c_pass, $user_password)) {
                              $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
                              $update_pass = mysqli_query($con, "UPDATE bridgeplayers SET pass='$hashed_password' WHERE email='$user'");
                              echo "
                                    <div class='alert alert-success'>
                                      <strong>" . $infos->changed_password . "</strong> 
                                    </div>
                                  ";
                            }
                          }
                        ?>
                      </div>
                    </div> 
                  </div>
                  <div class="my-2 mx-3">
                      <button class="btn btn-secondary mt-3 btn-block" type="submit" name="change"> <?php echo $infos->update; ?> </button>
                  </div>
              </div>  
            </form>     
          </div>
        </div>
      </div>
    </div>    
  </main>

  <footer>
  <div class="navbar fixed-bottom justify-content-center align-content-center" id="main-footer">
      <div class="footer-container">
        <p class="copyright">
          Copyright &copy; 2020 by
          <a href="https://www.facebook.com/joanna.gertrud.kokot/" target="_blank">Aberratio</a>. All Rights Reserved
        </p>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
<script>
</script>