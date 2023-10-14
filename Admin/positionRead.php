
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['posID'])){

        $_SESSION['posID'] = $_POST['posID'];
        $sql = "SELECT * from position WHERE positionID = ".$_POST['posID'].";";
        $result = mysqli_query($conn, $sql);

        if($result){  
            $row = mysqli_fetch_assoc($result);

            
            echo json_encode(array('Name' => $row['Description'],'maxVote' => 
            $row['Max_Vote'],'win' => $row['WinnersCount'],'priority' => $row['Priority']));
        }
        else{
                die($conn);
        }
}



?>
