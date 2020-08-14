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
      <div class = "col-2"></div>
      <div class="col-8">
        <div class="container mt-5">
            <div class="card">
              <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                <?php echo $infos->about_us_header; ?>
              </h4>
              <a href='menu.php' class='text-decoration-none ml-2 mb-2'>
                <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
              </a> 
              <div class = "mx-3">
                <div class = "card my-2 p-0">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                     <h5><?php echo $infos->who_are_we; ?></h5>
                        
                    </a>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <div class = "row p-0  mx-2 my-2 border">
                          <div class = "col-12 h4">
                            Joanna Kokot
                          </div>
                          <div class = "col-3">
                              <img  class=" profile_picture rounded = d-block float-left" alt="Responsive image"src=''>
                          
                          </div>
                          
                          <div class ="col-9">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                          
                          </div>
                        </div>
                        <div class = "row p-0  mx-2 my-2 border">
                          <div class = "col-12 h4">
                            Jakub Kokot
                          </div>
                          <div class = "col-3">
                              <img  class=" profile_picture rounded = d-block float-left" alt="Responsive image"src=''>
                          
                          </div>
                          
                          <div class ="col-9">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                          
                          </div>
                        </div>
                      </div>
                  </div>
                  
                  
                </div>
                <div class = "card my-2 p-0">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <h5><?php echo $infos->inspiration; ?></h5>
                  </a>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body ml-2">
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                      </div>  
                    </div>
                </div>
                <div class = "card my-2 p-0">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <h5><?php echo $infos->target; ?></h5>
                  </a>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body ml-2">
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                      </div>  
                    </div>
                </div>
                <div class = "card my-2 p-0">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      <h5><?php echo $infos->support_us; ?></h5>
                  </a>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                      <div class="panel-body ml-2">
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                      </div>  
                    </div>
                </div>
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