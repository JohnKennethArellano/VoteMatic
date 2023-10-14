<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }




$sql = "SELECT ElectionID FROM election where Admin_ID = ".$_SESSION['ID']." and status = 'active';";
$res = $conn->query($sql);

if($res->num_rows > 0){
    $row = $res->fetch_assoc();
    $_SESSION['ElectionID'] = $row['ElectionID'];
    $election = "SELECT
    (SELECT COUNT(Description) FROM position WHERE ElectionID = ".$row['ElectionID']." and status != 'deleted') as Description, 
    (SELECT COUNT(fName) FROM candidate where ElectionID = ".$row['ElectionID']." and status != 'deleted') as Name,
    (SELECT COUNT(fName) FROM voter where ElectionID = ".$row['ElectionID']." and status != 'deleted') as Voter,
    (SELECT COUNT(DepartmentName) FROM department where ElectionID = ".$row['ElectionID']." and status != 'deleted') as Department,
    (SELECT COUNT(fName) FROM voter where ElectionID = ".$row['ElectionID']." and status = 'voted') as Voted";


    
    $electionResult = mysqli_query($conn, $election);  
    $row1 = mysqli_fetch_array($electionResult);


    if($row1 ){

        echo json_encode($row1);
    }
}











?>

