
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


        $sql = "SELECT * from admin WHERE AdminID = ".$_SESSION['ID'].";";
        $result = mysqli_query($conn, $sql);

        if($result == true){  
            $row = mysqli_fetch_assoc($result);

            $array = array('fName' => $row['FirstName'], 'mName' => 
            $row['MI'], 'lName' => $row['Surname'], 'email' => $row['email'], 'username' => $row['Username']);
            echo json_encode($array);
        }





?>
