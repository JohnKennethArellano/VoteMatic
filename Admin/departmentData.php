<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $department = "SELECT ID,DepartmentName FROM department WHERE ElectionId =".$_SESSION['ElectionID']." and status != 'deleted'";
    $departmentResult =$conn->query($department);

    if($departmentResult->num_rows > 0 ){
        echo '<option selected disabled value ="default">Select Department</option>';
        while($res = $departmentResult->fetch_assoc()){
            echo '<option value = '.$res['ID'].'>'. $res['DepartmentName'] .'</option>';
        }
    }
    else{
        echo '<option selected disabled value ="default">Select Department</option>';
    }

?>