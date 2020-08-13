<?php
session_start();
include("get_test_details.php");

$test_id = $_GET['biddingtest'];
$id_first = $_GET['id_first'];
$id_second = $_GET['id_second'];

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();


    
					
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<script type="text/javascript" src="js/biddingbox.js">

</script>

<body>

    <main>
        
        <div class= "row p-0 mt-5">
            <div class= "row p-0  mt-5 card col-5 mx-auto" id="brigde_table">
                <div class="col-12  p-0">
                    <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                    <?php 
                        global $con;
                        $id_first = $_GET['id_first'];
                        $get_user1 = "select * from bridgeplayers where id='$id_first'";
                        $run_user1 = mysqli_query($con, $get_user1);
                        $row1 = mysqli_fetch_array($run_user1);
                        $user_name1 = $row1['user'];

                        $id_second = $_GET['id_second'];
                        $get_user2 = "select * from bridgeplayers where id='$id_second'";
                        $run_user2 = mysqli_query($con, $get_user2);
                        $row2 = mysqli_fetch_array($run_user2);
                        $user_name2 = $row2['user'];
                        
                        echo "<div class=''>$user_name1 $infos->and $user_name2 $infos->performance</div>";
                    ?>
                    </h4>
                </div>
                <?php 
                    $link = "ranking_test.php?test_id=".$test_id;
                ?>
                <a href = '<?php echo $link?>' class='text-decoration-none ml-2 mb-2'>
                    <i class="text-decoration-none fas fa-long-arrow-alt-left mr-2">  <?php echo $infos->back;?></i>
                </a>
                <div class="col-12 mx-3 p-0"></div>
                <div class="col-12 mx-3 p-0"></div>
            
                
                <table class= " my-3 text-center" id="bidding_desk">
                    <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                    <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>
                    <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                    <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>

                </table>
                <div id="bidding_string"><?php get_player_bidding($test_id, $id_first, $id_second); ?></div>
            </div>
        </div>
        
        
        

        <div id="biddingbox" style="display: none;">

            <div id="biddingbox_top">
            </div>
            <div id="biddingbox_bottom">
                <button type="submit" class="biddingbox_bottom_button">&#10060;</button>
                <button type="submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                <button type="submit" class="biddingbox_bottom_button">&#10060;&#10060;</button> <!-- blue XX-->
                <button type="submit" class="biddingbox_bottom_button biddingbox_bottom_button_back" onclick="declare(38)">&#128584;</button>

            </div>
            <?php update_bidding($test_id); ?>
        </div>
        <div style="clear: both;"> </div>
        </div>

    </main>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>