<?php
$con = mysqli_connect("sql8.netmark.pl","filipmar_asia","asia123","filipmar_asia") or die("Connection was not established");

    function get_test($set, $friend) {
        global $con;

        $get_test_query = 'SELECT * from player_compare_tests JOIN compare_tests ON id_compare_test = id_comp_test JOIN questions 
        ON questions.id_comp_test = compare_tests.id_comp_test JOIN answers ON answers.id_question = questions.id_question 
        WHERE player_compare_tests.id_player_set = '.$set.' AND (player_compare_tests.id_first_player = '.$friend.' OR player_compare_tests.id_second_player = '.$friend.') 
        group by questions.id_question'; 
		
        $run_comparetest = mysqli_query($con,$get_test_query);
       
        $question_counter = 0;

        while($row_comparetest=mysqli_fetch_array($run_comparetest)){
            $question_id = $row_comparetest['id_question'];
            $run_question = mysqli_query($con, 'SELECT * FROM answers WHERE id_question = '.$question_id.'');
            $question_counter = $question_counter + 1;
            echo '<div class="col-sm-4" style="display: flex; align-items: left;"> 

            <ul style="list-style-type: none; margin-top: 20px; display: block; text-align: left;">
                <li style="font-size: 20px; margin-bottom: 10px;"> <b style="font-size: 20px;"> Pytanie '.$question_counter.' </b></br>'.toBridgeText($row_comparetest["question"]).' </li>';
                 
                $tmp = 0;
                while($row_answer=mysqli_fetch_array($run_question)) {
                    $tmp = $tmp + 1;
                    echo ' <li> <label> <input type="radio" id="'.$question_counter.'r'.$tmp.'" name="rate'.$question_id.'"  style="margin-right: 10px;" value="'.$row_answer["id_answer"].'">'.toBridgeText($row_answer["answer"]).'</label></li>';
                }

            echo '</ul>

            </div>';
        }
    }

    function toBridgeText($normalString) {

        $changedString = str_replace("!C", "<b style=\"color:green\">&clubs;</b>", $normalString);
        $changedString = str_replace("!D", "<b style=\"color:orange\">&diams;</b>", $changedString);
        $changedString = str_replace("!H", "<b style=\"color:red\">&hearts;</b>", $changedString);
        $changedString = str_replace("!S", "<b style=\"color:blue\">&spades;</b>", $changedString);

        return $changedString;
    }

    function getCompString() {
        
    }
?>