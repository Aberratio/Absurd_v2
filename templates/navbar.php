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
                <div class="nav-item mt-3 mx-2 p-0">
                    <p class="text-light "> <?php echo $infos->score . ": " . $_SESSION['player_points']; ?> </p>
                </div>
                <div class="nav-item mt-2 p-0">
                    <div class="dropdown ">

                        <button class="btn btn-primary-no-focused-border dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class='profile_picture_nav' src='<?php echo $_SESSION['profile_picture']; ?>'>
                            <i style="color:white;"><?php echo $_SESSION['user']; ?></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" data-toggle="modal" data-target="#userInfoModal" href="#"><?php echo $infos->show_profile; ?></a>

                            <a class="dropdown-item" href="account_settings.php"><?php echo $infos->settings; ?></a>
                        </div>
                    </div>


                </div>
                <div class="nav-item mt-3 mb-2 mx-2 p-0">
                    <a class="text-decoration-none text-light" href="logout.php"><?php echo $infos->logout; ?></a>
                </div>
            </ul>
        </div>
    </div>
</nav>
<!-- DATAS -->
<?php
$user = $_SESSION['email'];
$get_user = "select * from bridgeplayers where email='$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$get_comments = "select COUNT(*) from comments where id_player=" . $_SESSION['id'];
$run_comments = mysqli_query($con, $get_comments);
$row_comments = mysqli_fetch_array($run_comments);

$user_name = $row['user'];
$user_pass = $row['pass'];
$user_email = $row['email'];
$user_visits = $row['visits'];
$profile_picture = $row['profile_picture'];
$role = $row['role'];
if ($role == 1) {
    $function = $infos->admin;
} else if ($role  == 2) {
    $function =  $infos->trainer;
} else if ($role  == 3) {
    $function = $infos->user;
}

?>
<!-- MODAL -->
<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="helperModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row mx-0">
                <div class="row col-12 p-0 mx-0">
                    <div class="col-12 px-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="row  col-12 p-0 mx-0 text-center">
                    <div class="col-12">
                        <h3 class="text-capitalize"><?php echo $user_name; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row mx-0 my-4">

                <div class=" ml-3 mr-2  d-block">
                    <img src="<?php echo $profile_picture; ?>" class=" profile_picture rounded mx-auto d-block float-left" alt="Responsive image">
                </div>
                <div class="mx-3 my-2">
                    <div> <a href="ranking.php" class="text-decoration-none"><?php echo $infos->score . ": " . $_SESSION['player_points']; ?> </a> </div>
                    <div><?php echo $infos->login_amount ?><?php echo $user_visits ?></div>
                    <div><?php echo $infos->permitions ?><?php echo $function ?></div>
                    <div><?php echo $infos->comment_amount ?><?php echo $row_comments[0] ?></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $infos->close ?></button>
            </div>
        </div>
    </div>
</div>