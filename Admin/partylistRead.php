
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['pID'])){

        $_SESSION['editPart'] = $_POST['pID'];
        
        $sql = "SELECT * from partylist WHERE ID = ".$_POST['pID'].";";
        $result = mysqli_query($conn, $sql);

        if($result){  
            $row = mysqli_fetch_assoc($result);
            echo $row['partylistname'];
        }
        else{
                die($conn);
        }
}



?>
