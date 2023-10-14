<head>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="AdminUI.css">
</head>

<?php

session_start();
require("../conn/connection.php");
if($_SESSION['check'] !== "check"){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}

date_default_timezone_set('Asia/Manila'); 

if(isset($_POST['create'])){


    $electionName = mysqli_real_escape_string($conn,$_POST['electionName']);
    $start = date('Y-m-d H:i:s',strtotime($_POST['staTime']));
    $end = date('Y-m-d H:i:s',strtotime($_POST['stoTime']));
    $sql_array = array();

    $sql = "INSERT INTO `election`(`ElectionID`, `Admin_ID`, `ElectionName`, `Start`, `End`, `status`) VALUES 
    ('',".$_SESSION['ID'].",'$electionName','$start','$end','active')";

    $result = mysqli_query($conn, $sql);

    if($result == true) {
        $sql1 = "SELECT * FROM election where Admin_ID = ".$_SESSION['ID'].";";
        $result1 = mysqli_query($conn, $sql1);
        $row = mysqli_fetch_assoc($result1);

        $sql_array[] = "INSERT INTO `department`(`ID`, `DepartmentName`, `ElectionID`, `status`) VALUES ('','No Department',".$row['ElectionID'].",'default')";
        $sql_array[] = "INSERT INTO `partylist`(`ID`, `partylistname`, `ElectionID`, `status`) VALUES ('','No Partylist',".$row['ElectionID'].",'default')";
        $sql_array[] = "INSERT INTO `position`(`positionID`, `ElectionID`, `Description`, `Max_Vote`, `Priority`, `status`) VALUES ('',".$row['ElectionID'].",'No Position','1','99','default')";

        foreach($sql_array as $sql_row){
            $result2 = mysqli_query($conn, $sql_row);
            $_SESSION['eID'] = $row['ElectionID'];
            $_SESSION['eName'] = $row['ElectionName'];
            echo '
            <script>
            $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    iconColor: "#30a702",
                    title: "Election Created",
                    showConfirmButton: false,
                    timer: 1500,
                  })
                  .then(function(){
                    window.location.href = "HomePage.php" 
                  })
            });
            </script>
            ';
        }
        
    }



}

?>