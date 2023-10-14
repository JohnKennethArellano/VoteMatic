<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $election = "SELECT * FROM election WHERE Admin_ID =".$_SESSION['ID']." and status = 'active'";
    $electionResult =$conn->query($election);

    if($electionResult->num_rows > 0 ){
        $row = mysqli_fetch_assoc($electionResult);
        echo '<div class="activeElection">
        <div class="electionName"><span id="active"> • &nbsp;</span>'.$row['ElectionName'].'</div>
        <div class="startTime">
            <div class="time">
            Scheduled Start<br>
                <span id="start">'.$row['Start'].'</span>
            </div>
        </div>
        <div class="endTime">
            <div class="time">
            Scheduled End<br>
                <span id="end">'.$row['End'].'</span>
            </div>
        </div>
        </div>';

    }

?>