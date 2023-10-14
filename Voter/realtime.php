<head>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="VoterUI.css">
</head>

<?php
    session_start();
    include("../conn/connection.php");
    if(!isset($_SESSION['userName'])){      
        echo'<script> window.location.href = "../index.php" ;</script>';  
        mysqli_close($conn)   ;  
        exit();
}


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
$date = strtotime($date);

$fndlctn = "SELECT * FROM election where ElectionID = ".$_SESSION['eID'].";";
$res = mysqli_query($conn,$fndlctn);

if(mysqli_num_rows($res) > 0){
    $r = mysqli_fetch_assoc($res);
    $start = strtotime($r['Start']);
    

    $diff = $date - $start;
    $hour = ( $diff / 3600);
    $minutes = ( $diff / 60 % 60);
    $seconds = ( $diff % 60 );
    $day = ( $hour / 24 );
    $hour = ( $hour % 24 );

    if($diff === -1){
        echo '<script>
        $(document).ready(function(){
            Swal.fire({
                icon: "warning",
                title: "Election is Starting",
                text: "Please Log In Again",
                showConfirmButton: false,
                timer: 1000,                 
              })
        })       
        </script>';
     
    }
    elseif($diff === 0){
        echo '<script> window.location.href = "../index.php" </script>';
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


