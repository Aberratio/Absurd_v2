<?php
	session_start();
	include("connect.php");
	//include("header.php");
?>
<?php 

if(!isset($_SESSION['is_logged'])){
  
  header("location: menu.php");

}
else { ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatile" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Absurd - platforma licytacyjna</title>
    <meta name="description" content="Strona do nauki gry w brydża">
	<meta name="keywords" content="brydż, licytacja, rozgrywka, bridge, absurd">
	<meta name="author" content="Joanna Kokot">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

<header>
    <nav class="navbar navbar-dark bg-absurd-col-light navbar-expand-md">
        <a class="navbar-brand" href="menu.php">
            <img src="img/logo.png" widht="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">
            Absurd
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainmenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="info.php">O stronie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">   
                    &nbsp;&nbsp;<img class='profile_picture' style='width:30px; height: 30px; border: 1px solid black; border-radius: 75%;' src='<?php echo $_SESSION['profile_picture'];?>'>&nbsp;&nbsp;&nbsp;(<i><?php echo $_SESSION['user'];?></i>) <b>Wyloguj<b></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main>

	<?php
      $user = $_SESSION['email'];
      $get_user = "select * from bridgeplayers where email='$user'"; 
      $run_user = mysqli_query($con,$get_user);
      $row=mysqli_fetch_array($run_user);
            
      $user_name = $row['user'];
      $user_profile = $row['profile_picture'];
      echo"
		
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

        if(isset($_POST['update'])){

          $u_image = $_FILES['u_image']['name'];
          $image_tmp = $_FILES['u_image']['tmp_name'];
          $random_number = rand(1,100);

          if($u_image==''){
            echo "<script>alert('Wybierz zdjęcie profilowe')</script>";
            echo "<script>window.open('upload.php','_self')</script>";
            exit();
          }else{
          
          move_uploaded_file($image_tmp,"img/$u_image.$random_number");

          
          $update = "update bridgeplayers set profile_picture='img/$u_image.$random_number' where email='$user'";
          
          $run = mysqli_query($con,$update); 
          
          if($run){
          
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