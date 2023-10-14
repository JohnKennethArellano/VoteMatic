<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $election = "SELECT * FROM election WHERE Admin_ID =".$_SESSION['ID']." Order by End DESC limit 1";
    $electionResult =$conn->query($election);

    if($electionResult->num_rows > 0 ){
       
        while($row = mysqli_fetch_assoc($electionResult)){
            echo '
            <div class="endedElection">
            <div class="electionName"><span id="ended"> • &nbsp;</span>'.$row['ElectionName'].' </div>
            <div class="startTime">
                <div class="time">
                    Start Time<br>
                    <span id="startEnded">'.$row['Start'].'</span>
                </div>
            </div>
            <div class="endTime">
                <div class="time">
                    End Time<br>
                    <span id="endEnded">'.$row['End'].'</span>
                </div>
            </div>
            <div class="res">            
                <button type="button" class="viewResult" value ="'.$row['ElectionID'].'" class="viewResult">VIEW RESULT</button>
            </div>
            </div>';
        }

    }
    else{
        echo '            
        <div class="endedElection">
        <div class="electionName">No Election Found</div>
        </div>';
    }

?>