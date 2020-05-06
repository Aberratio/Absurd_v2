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
    <div class="row">
      <div class="col-sm-2">
      </div>
      <?php
      $user = $_SESSION['email'];
      $get_user = "select * from bridgeplayers where email='$user'";
      $run_user = mysqli_query($con, $get_user);
      $row = mysqli_fetch_array($run_user);

      $user_pass = $row['pass'];
      ?>
      <div class="col-sm-8">
        <h2 style="color: rgb(247, 109, 109); margin-top: 20px; margin-left: 70px;"><?php echo $infos->change_email; ?></h2>
        <form action="" method="post" class="settings_form" enctype="multipart/form-data">
          <table>

            <tr>
              <td style="font-weight: bold;"><?php echo $infos->current_password; ?></td>
              <td>
                <input class="form-control" type="password" name="current_pass" id="mypass" required="required" placeholder="<?php echo $infos->current_password; ?>" />
              </td>
            </tr>

            <tr>
              <td style="font-weight: bold;"><?php echo $infos->new_password; ?></td>
              <td>
                <input class="form-control" type="password" name="u_pass1" id="mypass" required="required" placeholder="<?php echo $infos->new_password; ?>" />
              </td>
            </tr>

            <tr>
              <td style="font-weight: bold;"><?php echo $infos->repeat_new_password; ?></td>
              <td>
                <input class="form-control" type="password" name="u_pass2" id="mypass" required="required" placeholder="<?php echo $infos->repeat_new_password; ?>" />
              </td>
            </tr>

            <tr align="center">
              <td colspan="6">
                <input class="update_button" type="submit" name="update" value="<?php echo $infos->update; ?>" />
              </td>
            </tr>
          </table>
        </form>


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
                  <div class='alert alert-danger'>
                    <strong>" . $infos->password_changed . "</strong> 
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