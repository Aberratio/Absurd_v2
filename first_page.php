<?php
session_start();

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['pl']; //space for future languages
$lang = in_array($lang, $acceptLang) ? $lang : 'eng';
require_once "lang/lang_{$lang}.php"; 

$infos = new Infos();


if ((isset($_SESSION['is_logged'])) && ($_SESSION['is_logged'] == true)) {
    header('Location: menu.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top py-1">
        <div class="container">
            <a class="navbar-brand" href="first_page.php">
                <img src="img/logo_Asia_rev.png" alt="" width="50" height="50" />
                <h3 class="d-inline align-middle">Absurd</h3>
                <img src="img/logo_Domi_rev.png" alt="" width="50" height="50" />
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="nav-item mt-3 mb-2 mx-2 p-0">
                <a class="text-decoration-none text-light" href="logout.php"><?php echo $infos->sth; ?></a>
            </div>
            <div class="nav-item mt-3 mb-2 mx-2 p-0">
                <a class="text-decoration-none text-light" href="logout.php"><?php echo $infos->sth; ?></a>
            </div>
            <div class="nav-item mt-3 mb-2 mx-2 p-0">
                <a class="text-decoration-none text-light" href="logout.php"><?php echo $infos->sth; ?></a>
            </div>
            <div class="dropdown ">

                            <button class="btn btn-primary-no-focused-border dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#" href="#"><?php echo $infos->sth; ?></a>
                                <a class="dropdown-item" href="#"><?php echo $infos->sth; ?></a>
                            </div>
                        </div>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                   
                  
                    <div class="nav-item mt-3 mb-2 mx-2 p-0">
                        <a class="text-decoration-none text-light" href="logout.php"><?php echo $infos->log_in; ?></a>
                    </div>
                    <div class="nav-item mt-3 mb-2 mx-2 p-0 text-white">
                        <?php echo $infos->or; ?>
                    </div>

                    <div class="nav-item mt-3 mb-2 mx-2 p-0">
                        <a class="text-decoration-none text-light" href="registration.php"><?php echo $infos->register; ?></a>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
       <!-- BODY -->
        <div class = "row p-0 m-0">
            <div class = "col-12 mt-5 my-container">
                <img src="img/brydż.jpg" alt="zdjecie brydz">
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