<?php
session_start();
include("get_training_groups.php");
include("connect.php");
      
if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['role'] == 3) {
    header('Location: menu.php');
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
<script type="text/javascript" src="js/add_test.js">

</script>

<body>

    <main>
        <div class ="container mt-5">
            <div class="row my-5">
                <div class="col-sm-12 col-md-8 col-lg-6 my-5">
                    <div class=" bg-white rounded p-1 mt-3 mx-auto">
                        <div class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white ">
                            <div class = "my-2">
                                Wprowadź nowy set!
                            </div>
                        </div>
                        <div class="row m-0">
                        
                            <div class="col-12 "id="view-panel" style="float: left">
                    
                                <?php
                                echo '
                                        <form name="add">
                                        <select id="sets" name="sets">
                                            ';
                                $get_set_query = 'SELECT * from bidding_sets';

                                $run_sets = mysqli_query($con, $get_set_query);

                                while ($row_comparetest = mysqli_fetch_array($run_sets)) {
                                    $set_name = $row_comparetest['set_name'];
                                    $set_id = $row_comparetest['id_set'];

                                    echo '
                                                <option value="' . $set_id . '" set_name="' . $set_id . '">' . $set_name . '</option>';
                                }
                                echo '    
                                        </select>
                                        <input type="hidden" id="name" name="name" value=""/>
                                        </form>
                                    ';

                                ?>
                            </div>
                        
                            <div class="col-12">
                                <label for="x">Punkty <input class="form-control" type='text' id='points_input' name='points_input' /></label>
                            </div>
                        </div>
                        <div class = "row mx-3 ">
                            <div class= "row m-0">
                                <div class = "col-5  bg-primary text-center rounded text-white">
                                    <div class = "mb-3">Ręka N</div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:blue">♠</b></span>
                                            
                                        </div>
                                        <input class="form-control " type='text' name="N_hand_spade" />
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:red">♥</b></i></span>
                                        </div>
                                        <input class="form-control " type='text' name="N_hand_heart" />
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:orange">♦</b></i></span>
                                        </div>
                                        <input class="form-control " type='text' name="N_hand_diamond" />
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:green">♣</b></span>
                                        </div>
                                        <input class="form-control " type='text' name="N_hand_club" />
                                    </div>
                                </div>
                                <div class = " col-2 "></div>
                                <div class = " col-5   bg-primary text-center rounded text-white">
                                <div class = "mb-3">Ręka S</div>
                                <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:blue">♠</b></i></span>
                                        </div>
                                        <input class="form-control " type='text' name="S_hand_spade" />
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:red">♥</b></i></span>
                                        </div>
                                        <input class="form-control " type='text' name="S_hand_heart" />
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:orange">♦</b></i></span>
                                        </div>
                                        <input class="form-control " type='text' name="S_hand_diamond" />
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text "><b style="color:green">♣</b></i></span>
                                        </div>
                                        <input class="form-control " type='text' name="S_hand_club" />
                                    </div>
                                </div>
                            </div>
                            <div class = "col-12 p-0">
            
                                <p><button class="btn btn-secondary mt-3  btn-block" name="add_test">Dodaj!</button></p>
                                    
                                
                            </div>

                        </div>
                        
                           
                            
                            <?php
                            
                            if (isset($_POST['add_test'])) {
                                if (isset($_POST['new_set'])) {
                                    //mysqli_query($con, 'INSERT INTO `bidding_sets`(`id_set`, `set_name`, `set_type`) VALUES (0,"' . $_POST['set_name'] . '",0)');
                                }
                                //global values
                                
                                $is_correct = true;
                                $allowed_characters = "AKQJ1098765432;-";
                                $array_of_allowed_characters = str_split($allowed_characters);
                                $hand =1;
                                $first_hand=$_POST['S_hand'];
                                $second_hand=$_POST['N_hand'];
                                check_content();

                                    $first_spade  ="";
                                    $first_heart  ="";
                                    $first_diamond="";
                                    $first_club   ="";
                                    
                                    $second_spade  ="";
                                    $second_heart  ="";
                                    $second_diamond="";
                                    $second_club   ="";


                                
                                $set_id = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bidding_sets WHERE set_name = "' . $_POST['set_name'] . '"'));
                                $test_counter = mysqli_fetch_array(mysqli_query($con, 'SELECT COUNT(*) FROM bidding_tests JOIN bidding_sets ON bidding_tests.id_set = bidding_sets.id_set WHERE set_name = "' . $_POST['set_name'] . '"'))[0] + 1;

                                if($is_correct){
                                    //mysqli_query($con, 'INSERT INTO `bidding_tests`(`id_test`, `level`, `S_hand`, `N_hand`, `point_string`, `id_set`, `declarer`,  `test_number`) 
                                    //VALUES (0,1,"' . $_POST['S_hand'] . '","' . $_POST['N_hand'] . '","' . $_POST['points_input'] . '",' . $set_id["id_set"] . ',2,' . $test_counter . ')');
                                    echo "Dodano nowy test!";
                                    echo "<br/>";
                                    echo "RękaN: ".$first_hand;echo "<br/>";
                                    echo "RękaS: ".$second_hand;echo "<br/>";
                                    
                                }else{
                                    echo "Wykryto błąd!";
                                }
                            }
                            
                            
                            function check_content(){
                                global $first_hand, $second_hand;
                                global $allowed_characters, $array_of_allowed_characters;
                                global $hand;
                                global $first_spade, $first_heart, $first_diamond, $first_club, $second_spade, $second_heart, $second_diamond, $second_club;
                            //first hand
                                check_length($first_hand);
                                cut_until_semicolon($first_hand, $first_spade, $first_heart, $first_diamond, $first_club);
                                $first_hand = replace_synonyms($first_hand);
                                checking_for_forbidden_characters($first_hand);
                                

                            //second hand 
                                check_length($second_hand);
                                cut_until_semicolon($second_hand, $second_spade, $second_heart, $second_diamond, $second_club);
                                $second_hand = replace_synonyms($second_hand);
                                checking_for_forbidden_characters($second_hand);
                                

                            //both hands
                                $first_spade  .=  $second_spade;
                                $first_heart  .=  $second_heart;
                                $first_diamond.=  $second_diamond;
                                $first_club   .=  $second_club;
                                checking_for_doubled_characters($first_spade);
                                checking_for_doubled_characters($first_heart);
                                checking_for_doubled_characters($first_diamond);
                                checking_for_doubled_characters($first_club);



                            }
                        
                            
                            function cut_until_semicolon($text, $sp, $he, $di, $cl){
                                global $hand;
                                global $first_spade, $first_heart, $first_diamond, $first_club, $second_spade, $second_heart, $second_diamond, $second_club;
                                if(substr_count ($text , ";")!=3){
                                    $is_correct = false;
                                    echo "too small amount of suits";
                                }else{
                                    $replacement_array = array('-' => '',' ' => '');
                                    $new_string    = str_replace(array_keys($replacement_array), array_values($replacement_array), $text);

                                    $sp = substr($new_string,0, strpos($new_string, ';'));
                                    $new_string = substr_replace ( $new_string , "" , 0,  strpos($new_string, ';')+1) ;

                                    $he = substr($new_string,0, strpos($new_string, ';'));
                                    $new_string = substr_replace ( $new_string , "" , 0,  strpos($new_string, ';')+1) ;

                                    $di = substr($new_string,0, strpos($new_string, ';'));
                                    $new_string = substr_replace ( $new_string , "" , 0,  strpos($new_string, ';')+1) ;
                                
                                    $cl = $new_string;
                                    
                                    if($hand ==1)
                                    {
                                        $first_spade  =$sp;
                                        $first_heart  =$he;
                                        $first_diamond=$di;
                                        $first_club   =$cl;
                                        $hand=2;
                                        

                                    }else{
                                        $second_spade  =$sp;
                                        $second_heart  =$he;
                                        $second_diamond=$di;
                                        $second_club   =$cl;
                                        $hand=1;
                                    }
                                }
                            }
                            function check_length($text){ 
                                global $is_correct;
                                $replacement_array = array(';' => '','-' => '',' ' => '', '10'=>'0');
                                $text= str_replace(array_keys($replacement_array), array_values($replacement_array), $text);

                                if(strlen($text)!=13){
                                    $is_correct = false;
                                    echo "need more cards";
                                }
                            }
                            function replace_synonyms($text){
                                $replacementArray = array(
                                'W' => 'J','w' => 'J','j' => 'J',
                                'D' => 'Q','d' => 'Q','q' => 'Q',
                                'k' => 'K',
                                'a' => 'A');

                                return str_replace(array_keys($replacementArray), array_values($replacementArray), $text);
                            }

                            function checking_for_forbidden_characters($text){
                                global $allowed_characters;
                                global $is_correct;
                                $array_of_characters = str_split($text);

                                foreach($array_of_characters as $character){
                                    if(stripos($allowed_characters, $character)===false)
                                    {
                                        echo $character;echo "<br>";echo "<br>";
                                        
                                        $is_correct = false;
                                        echo "wrong sign";
                                        
                                    }
                                }
                            }
                            function checking_for_doubled_characters($text){
                                global $is_correct, $array_of_allowed_characters;
                                foreach($array_of_allowed_characters as $character){
                                    if(substr_count($text , $character )>1){
                                        $is_correct = false;
                                        echo "doubled character";
                                        break;
                                    }
                                }
                            }
                            ?>
                            </form>
                    
                    </div>
                </div>    
                
                <div class="col-sm-12 col-md-8 col-lg-4 my-5 mx-5 p-0">
                    <div class=" bg-white rounded p-0 mt-3 mx-auto">
                            <div class = "row p-0 m-0">
                                <div class = "col-1"></div>
                                    <div class = "col-10 my-2 p-0 text-left">
                                        <button class=" btn btn-secondary dropdown-toggle btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Set
                                        </button>
                                        <hr>
                                    </div>
                                </div>
                                <div class="scrollbar scrollbar-primary">
                                    <div class="force-overflow">
                                       
                                    </div>    
                                </div>

                        
                                        
                
                
                
                    </div>
                </div>
                 <!-- buttons :) 
                <div class="col-lg-6 my-5 ">
                   
                    <div id="brigde_table" >
                        <div id="biddingbox">
                            <div id="biddingbox_top">
                            </div>
                            <div id="biddingbox_bottom">
                                <button type="submit" class="biddingbox_bottom_button"">&#10060;</button>
                        <button type=" submit" class="biddingbox_bottom_button">PASS</button>
                                <button type="submit" class="biddingbox_bottom_button"">&#10060;&#10060;</button>  blue XX
                                <button type=" submit" class="biddingbox_bottom_button biddingbox_bottom_button_back">&#128584;</button>
                            </div>
                        </div>
                    </div>
                    
                    -->
                    
                </div>
            </div>
        </div>
       
    <!--
       
    -->
            <div>
                <div id="aha"> </div>
                <script type="text/javascript" language="javascript">
                    $(function() {
                        $("#sets").change(function() {
                            var studentName = $('option:selected', this).attr('set_name');
                            $('#name').val(studentName);
                            var xd = $('#name').val();
                            document.getElementById("aha").innerHTML = xd;

                            <?php
                            $cos = '<script type="text/javascript">document.write(xd)</script>';
                            $get_set_query = "SELECT * from bidding_tests where id_set = " . $cos . ";";

                            $run_sets = mysqli_query($con, $get_set_query);

                            while ($row_comparetest = mysqli_fetch_array($run_sets)) {
                                $set_name = $row_comparetest['set_name'];
                                $set_id = $row_comparetest['id_set'];

                                echo '
                            <option value="' . $set_id . '" set_name="' . $set_id . '">' . $set_name . '</option>';
                            }
                            ?>

                        });
                    });
                </script>
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