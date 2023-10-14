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


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
$date = strtotime($date);

$fndlctn = "SELECT * FROM election where ElectionID = ".$_SESSION['eID']." and status = 'active';";
$res = mysqli_query($conn,$fndlctn);

if(mysqli_num_rows($res) > 0){
    $r = mysqli_fetch_assoc($res);
    $end = strtotime($r['End']);
    

    $diff = $date - $end;
    $hour = ( $diff / 3600);
    $minutes = ( $diff / 60 % 60);
    $seconds = ( $diff % 60 );
    $day = ( $hour / 24 );
    $hour = ( $hour % 24 );

    if($diff == -300){
        echo '<script>
        $(document).ready(function(){
            Swal.fire({
                icon: "warning",
                title: "This Election will End Soon",
                text: "Please Log In Again",
                showConfirmButton: false,
                timer: 1000,                 
              })
        })       
        </script>';
    }
    else if( $diff == -1){
        echo '<script>
        $(document).ready(function(){
            Swal.fire({
                icon: "warning",
                title: "Election has Ended",
                text: "Please Log In Again",
                showConfirmButton: false,
                timer: 1000,                 
              })
        })       
        </script>';
    }
    else if( $diff >= 0){
        $upd = "UPDATE `election` SET `status`='ended' WHERE ElectionID = ".$_SESSION['eID'].";";
        $result = mysqli_query($conn, $upd);
        if($result == true){
            echo '<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: "warning",
                    title: "Election has Ended",
                    text: "Please Log In Again",
                    showConfirmButton: false,
                    timer: 1000,                 
                  })
                  .then(function(){
                    window.location.href = "../index.php";
                  })

                  
            })       
            </script>';
           
        }
        
    }
    else{       
        if ($day < 0){
            echo abs(ceil($day));
        }
        else{
            echo floor($day);
        }
        echo " Day | ";
        echo abs($hour) ." Hour | ".abs($minutes) ." Minute | ".abs($seconds)." Second";
    }
}


?>


