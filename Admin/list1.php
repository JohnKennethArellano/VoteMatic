<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $query = "SELECT ID, DepartmentName FROM department WHERE ElectionID =".$_SESSION['ElectionID']." and status != 'deleted' ORDER BY ID DESC;";
    $result =$conn->query($query);

    if($result->num_rows > 0 ){

        while($res = $result->fetch_assoc()){
            echo "<span class='group'>".$res['DepartmentName']."</span>";

            $query1 = "SELECT CONCAT(lName,', ',fName,', ',mName) as Name from voter where DepartmentID =".$res['ID']." and status != 'deleted';";
            $result1 = $conn->query($query1);

            if($result1->num_rows > 0 ){

                while($res1 = $result1->fetch_assoc()){
                    echo "<span class='votersName'>".$res1['Name']."</span>";
                }
            }
            else{
                echo "<span class='votersName'>No Voters</span>";
            }

        }
    }
    else{
        echo "<span class='group'>No Departments</span>";
    }





?>