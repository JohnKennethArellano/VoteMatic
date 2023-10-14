
<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $query = "SELECT positionID, Description FROM position WHERE
     ElectionId =".$_SESSION['ElectionID']." and status != 'deleted' ORDER BY Priority ASC;";

    $result =$conn->query($query);

    if($result->num_rows > 0 ){

        while($res = $result->fetch_assoc()){
            echo "<span class='position'>".$res['Description']."</span>";

            $query1 = "SELECT CONCAT(UPPER(lName),', ',fName,' ', mName ) as Name FROM candidate where PositionID =".$res['positionID']." and status != 'deleted';";
            $result1 = $conn->query($query1);

            if($result1->num_rows > 0 ){

                while($res1 = $result1->fetch_assoc()){
                    echo "<span class='nameCandidates'>".$res1['Name']."</span>";
                }
            }
            else{
                echo "<span class='nameCandidates'>No Candidates</span>";
            }

        }
    }
    else{
        echo "<span class='position'>No Positions</span>";
    }





?>
