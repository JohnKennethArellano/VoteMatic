<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $position = "SELECT * FROM position WHERE ElectionID =".$_SESSION['ElectionID']." and status != 'deleted' order by priority";
    $positionResult =$conn->query($position);

    if($positionResult->num_rows > 0 ){
        echo '<option selected disabled value ="default">Select Position</option>';
        while($res = $positionResult->fetch_assoc()){
            echo '<option value = '.$res['positionID'].'>'. $res['Description'] .'</option>';
        }
    }
    else{
         echo '<option selected disabled value ="default">Select Position</option>';
    }

?>