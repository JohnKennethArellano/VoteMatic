
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['cID'])){

        $_SESSION['canID'] = $_POST['cID'];
        $sql = "SELECT * from candidate WHERE CandidateID = ".$_POST['cID'].";";
        $result = mysqli_query($conn, $sql);

        if($result){  
            $row = mysqli_fetch_assoc($result);

            $sql1 = "SELECT * from position WHERE positionID = ".$row['PositionID'].";";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);

            $sql2 = "SELECT * from partylist WHERE ID = ".$row['partylist'].";";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            $array = array('ID' => $row['CandidateID'],'fName' => $row['fName'], 'mName' => 
            $row['mName'], 'lName' => $row['lName'],'picture' => $row['profile'], 'position' => $row1['Description'], 'platform' => $row['Platform'], 'partylist' => $row2['partylistname']);
            echo json_encode($array);
        }
        else{
                die($conn);
        }
}



?>
