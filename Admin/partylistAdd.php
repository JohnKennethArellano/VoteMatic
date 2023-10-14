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


if(isset($_POST['addPartylist'])){
        


        $partName = mysqli_real_escape_string($conn,$_POST['partName']);
        $partName  = ucfirst($partName);

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
                        text: "Cannot Add Partylist",
                        showConfirmButton: false,
                        timer: 1000,                 
                      })
                      .then(function(){
                        window.location.href = "partylist.php" 
                      })
                })       
                </script>';
            }
            else{
                $sql = "INSERT INTO `partylist`(`ID`, `partylistname`, `ElectionID`, `status`) VALUES ('','$partName','".$_SESSION['ElectionID']."','active')";
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
                                window.location.href = "partylist.php" 
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
