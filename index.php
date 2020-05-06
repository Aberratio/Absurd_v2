<?php
session_start();

if ((isset($_SESSION['is_logged'])) && ($_SESSION['is_logged'] == true)) {
    header('Location: menu.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>

<body>
    <div class="site-container">
        <div class="container mt-5">
            <div class="card main-form p-5 m-auto">
                <!-- LOGO -->
                <div class="row align-items-center justify-content-center mb-3">
                    <img class="col-5 col-sm-3 col-md-3 logo mr-sm-3" src="img/logo_Asia.png" alt="Absurd - logo" class="logo" />
                    <h1 class="col-12 col-sm-5 text-center">Absurd</h1>
                    <img class="col-5 col-sm-3 col-md-3 logo mr-sm-3" src="img/logo_Domi.png" alt="Absurd - logo" class="logo" />
                </div>

                <!-- LOGIN FORM -->

                <form class="login-form text-center" action="login.php" method="post">
                    <!-- TEXT FIELD GROUPS -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control" type="text" id="nickname" name="login" placeholder="Nickname" required="required" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-unlock-alt"></i></span>
                        </div>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" required="required" />
                    </div>
                    <button class="btn btn-secondary btn-block" type="submit">
                        Practice!
                    </button>
                    <?php
                    if (isset($_SESSION['error_login'])) {
                        echo $_SESSION['error_login'];
                    }
                    ?>
                    <div class="mb-4 mt-4">
                        <p class="text-center">OR</p>
                    </div>
                    <a class="btn btn-primary btn-block" href="registration.php">Create an account</a>
                    <a class="text-center d-block mt-3" href="forgot_pass.php">Forgot password?</a>
                </form>
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