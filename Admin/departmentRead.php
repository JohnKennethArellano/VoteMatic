
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['dID'])){

        $_SESSION['editDept'] = $_POST['dID'];
        
        $sql = "SELECT * from department WHERE ID = ".$_POST['dID'].";";
        $result = mysqli_query($conn, $sql);

        if($result){  
            $row = mysqli_fetch_assoc($result);
            echo $row['DepartmentName'];
        }
        else{
                die($conn);
        }
}



?>
