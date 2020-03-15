<?php
session_start();

if (!isset($_SESSION['is_registred'])) {
    header('Location: index.php');
    exit();
} else {
    unset($_SESSION['is_registred']);
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>

    <title>Absurd - Bridge Platform</title>
    <meta name="description" content="Strona do nauki gry w brydża">
    <meta name="keywords" content="brydż, licytacja, rozgrywka, bridge, absurd">
    <meta name="author" content="Joanna Kokot">

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <main>
        <h1 class="text-info"> Registration successful! Log in to your account.
            <a href="index.php" class="text-warning">Log In!</a> </h1>
    </main>


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