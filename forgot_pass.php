<?php

    if((isset($_SESSION['is_logged'])) && ($_SESSION['is_logged'] == true)) {
        header('Location: menu.php');
        exit();
    } 
?>

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
</head>
<body>

<header>
    <nav class="navbar navbar-dark bg-absurd-col-light navbar-expand-md">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" widht="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">
            Absurd
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainmenu">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Zaloguj</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Zarejestruj</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="info.php">O stronie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Kontakt</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<main>
<div class="signin-form">
    <form action="" method="post">
		<div class="form-header">
			<h2>Resetowanie hasła</h2>
		</div>
		<div class="form-group">
			<label>Email</label>
        	<input type="text" class="form-control" placeholder="someone@site.com" name="email" autocomplete="off" required="required">
        </div>
        <div class="form-group">
			<label>Cezar</label>
            <input type="text" class="form-control" placeholder="cezar" name="cezar" autocomplete="off" required="required">
        </div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">Wyślij</button>
		</div>
    </form>
	<div class="text-center small" style='color:#67428B;'>Powrót do <a href="index.php">logowania</a></div>
</div>
</main>

<footer>

</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
<?php 
session_start();

include("connect.php"); 

	if(isset($_POST['submit'])){
	
	$email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
	$recovery_account = htmlentities(mysqli_real_escape_string($con,$_POST['cezar']));
	
	$select_user = "select * from users where user_email='$email' AND forgotten_answer='$recovery_account'";
	
	$query = mysqli_query($con,$select_user); 
	
	$check_user = mysqli_num_rows($query);
	
	if($check_user==1){
	
	$_SESSION['user_email']=$email;
	
	echo "<script>window.open('create_password.php','_self')</script>";
	
	}
	else {
	echo "<script>alert('Your Email or your cezar number is Incorrect')</script>";
	echo "<script>window.open('forgot_pass.php','_self')</script>";
	}
	
	}


?>