<?php
session_start();
include("get_folder.php");

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['role'] == 3) {
    header('Location: menu.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            My folders
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="page">

                                <div class="accordion-option">
                                    <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                            <h4 class="panel-title text-capitalize">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    Grupa początkująca - Wrocław
                                                </a>
                                                <small>
                                                    <i class="fas fa-trash-alt ml-2"></i>
                                                    <i class="fas fa-edit ml-2"></i>
                                                </small>
                                            </h4>
                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab aspernatur necessitatibus voluptas veritatis blanditiis. Hic omnis soluta repellendus! Vero, eveniet?</p>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tournament</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php get_folder_table(); ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title text-capitalize">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    Zaawansowani - PWr
                                                </a>
                                                <small>
                                                    <i class="fas fa-trash-alt ml-2"></i>
                                                    <i class="fas fa-edit ml-2"></i>
                                                </small>
                                            </h4>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto rerum eius tempora inventore nulla accusantium doloribus qui ratione possimus eveniet.</p>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title text-capitalize">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Juniorki - kadra A
                                                </a>
                                                <small>
                                                    <i class="fas fa-trash-alt ml-2"></i>
                                                    <i class="fas fa-edit ml-2"></i>
                                                </small>
                                            </h4>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores sit modi consectetur numquam voluptatem natus tenetur quidem asperiores voluptas veritatis?</p>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <!-- End Pleyer Panel -->

            <!-- Add new folder -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            Add new folder
                        </h4>
                        <hr class="hr-dark py-3" />
                        <form method="get" class="mx-3">
                            <input type="text" class="form-control mb-2" placeholder="Folder name" name="group_name" />
                            <textarea class="form-control mb-2" placeholder="Description" name="description"> </textarea>
                            <p><button class="btn btn-secondary mt-3 btn-block" name='add_folder'>Add</button></p>
                            <?php
                            if (isset($_GET['add_folder'])) {
                            }
                            ?>
                        </form>
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