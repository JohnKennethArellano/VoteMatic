<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


    $query = "SELECT CONCAT(UPPER(lName),', ',fName,' ', mName ) as Name from voter where ElectionId =".$_SESSION['ElectionID']." AND status = 'voted';";
    $result =$conn->query($query);

    if($result->num_rows > 0 ){

        while($res = $result->fetch_assoc()){
            echo "<span class='votersVoted'>".$res['Name']."</span>";
        }
    }
    else{
        echo "<span class='votersVoted'>No Voters Voted</span>";
    }

?>




