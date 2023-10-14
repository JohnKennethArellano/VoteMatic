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


if(isset($_POST['addCandidate'])){


        $sName = mysqli_real_escape_string($conn,$_POST['csName']);
        $sName  = ucfirst($sName);
        $fName = mysqli_real_escape_string($conn,$_POST['cfName']);
        $fName  =ucfirst($fName);
        $mName = mysqli_real_escape_string($conn,$_POST['cmName']);
        $mName = strtoupper($mName);
        $platform = mysqli_real_escape_string($conn,$_POST['platform']);
        $position = $_POST['posAve'];
        $partylist = $_POST['parAve'];

  date_default_timezone_set('Asia/Manila');
  $date = date('Y-m-d H:i:s');
  $date = strtotime($date);
  
  $fndlctn = "SELECT * FROM election where ElectionID = ".$_SESSION['eID']." and status = 'active';";
  $res = mysqli_query($conn,$fndlctn);
  
  if(mysqli_num_rows($res) > 0){
      $r = mysqli_fetch_assoc($res);
      $start = strtotime($r['Start']);
      
  
      $diff = $start - $date;
  
      if($diff < 0){
          echo '<script>
          $(document).ready(function(){
              Swal.fire({
                  icon: "warning",
                  title: "Election Ongoing",
                  text: "Cannot Add Candidate",
                  showConfirmButton: false,
                  timer: 1000,                 
                })
                .then(function(){
                  window.location.href = "Candidates.php" 
                })
          })       
          </script>';
      }
      else {
        $sql = "INSERT INTO `candidate`(`CandidateID`, `ElectionID`, `lName`, `fName`, `mName`, `profile`, `PositionID`, `partylist`, `Platform`, `status`) VALUES
        ('',".$_SESSION['ElectionID'].",'$sName', '$fName', '$mName', 'default.jpg','$position', '$partylist' , '$platform ', 'active');";

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
                       window.location.href = "Candidates.php" 
                     })
               });
               </script>
               ';           
       }
       else{
               die($conn);
       }
      }


}

}

?>
