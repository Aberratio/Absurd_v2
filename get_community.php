<?php
include("get_test_details.php");

include("connect.php");

function get_experts_tabs($infos)
{
    global $con;

    $get_admins_query = 'SELECT * from bridgeplayers WHERE role =3';

    $run_biddingtest = mysqli_query($con, $get_admins_query);

    $place = 1;
    $last_points = -1;
    
    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $user_name = $row_biddingtest['user'];
        $user_picture = $row_biddingtest['profile_picture'];
        echo '
        
            <div class ="col-11 test  mx-auto my-2">
                <div class ="test-border">
                    <div class=" standard-title-sec p-0 mx-3 my-2 " >
                        <div class = " p-0">
                            '.$user_name.'
                        </div>
                    </div>
                    <div class="row p-0 mx-3">
                        <div class"col-4 ">
                            <img class="profile_picture mr-2 mb-2" style="width:150px; height: 150px; 
                                border: 1px solid black;" src="' . $user_picture . '">
                        </div> 
                        <div class"col-8 ml-2">
                        TEKST POTRZEBNY  TEKST POTRZEBNY 
                            <div class="progress my-4">
                                <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20%" aria-valuemin="20" aria-valuemax="100"></div>
                            </div>
                            <div class="progress my-4">
                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress my-4">
                                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class= "col-12  my-2">
                        Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis. Jakis super opis.  

                        </div>
                    </div>
                       
                        
                </div>  
            </div>
            
        ';
        
    }
}
?>

                            
                            