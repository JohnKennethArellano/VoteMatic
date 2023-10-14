<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }

if(isset($_POST['number'])){

    $query = "Select VoterID FROM voter WHERE VoterID = ".$_POST['number'].";";
    $result =$conn->query($query);

    if($result->num_rows > 0){
        echo json_encode(array('status' => 'error'));
    }
    
    else{
        echo json_encode(array('status' => 'success'));
    }

}
?>