<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $partylist = "SELECT * FROM partylist WHERE ElectionID =".$_SESSION['ElectionID']." and status != 'deleted'";
    $partylistResult =$conn->query($partylist);

    if($partylistResult->num_rows > 0 ){
        echo '<option selected disabled value ="default">Select Partylist</option>';
        while($res = $partylistResult->fetch_assoc()){
            echo '<option value = '.$res['ID'].'>'. $res['partylistname'] .'</option>';
        }
    }
    else{
        echo '<option selected disabled value ="default">Select Partylist</option>';
    }

?>