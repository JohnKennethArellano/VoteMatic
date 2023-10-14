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
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['addVoter'])){


        $sName = mysqli_real_escape_string($conn,$_POST['sName']);
        $sName  = ucfirst($sName);
        $fName = mysqli_real_escape_string($conn,$_POST['fName']);
        $fName  =ucfirst($fName);
        $mName = mysqli_real_escape_string($conn,$_POST['mName']);
        $mName = strtoupper($mName);
        $voterID = $_POST['generate'];
        $department = $_POST['dep'];

        $sql = "INSERT INTO `voter` (`VoterID`, `ElectionId`, `fName`, `mName`, `lName`, `DepartmentID`, `Username`, `password`) VALUES
         ($voterID,".$_SESSION['ElectionID'].",'$fName', '$mName', '$sName', '$department','$voterID', '$voterID');";

        $insert = mysqli_query($conn, $sql);

        if($insert){
                echo '
                <script>

                $(document).ready(function(){
                    Swal.fire({
                        title: "Added Successfully",
                        icon: "success",
                        iconColor: "#30a702",
                        showConfirmButton: false,
                        timer: 1000,
                      })
                      .then(function(){
                        window.location.href = "Voters.php" 
                      })
                });
                </script>
                ';           
        }
        else{
                die($conn);
        }
}



?>
