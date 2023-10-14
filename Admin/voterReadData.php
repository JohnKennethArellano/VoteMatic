
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['vID'])){

        $_SESSION['voterID'] = $_POST['vID'];
        $sql = "SELECT * from voter WHERE VoterID = ".$_POST['vID'].";";
        $result = mysqli_query($conn, $sql);

        if($result){  
            $row = mysqli_fetch_assoc($result);
            $sql1 = "SELECT DepartmentName from department WHERE ID = ".$row['DepartmentID'].";";

            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);

            
            echo json_encode(array('fName' => $row['fName'],'mName' => 
            $row['mName'],'lName' => $row['lName'],'DepartmentID' => $row1['DepartmentName'],));
        }
        else{
                die($conn);
        }
}



?>
