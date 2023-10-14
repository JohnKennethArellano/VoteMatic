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


if(isset($_POST['changePass'])){
    $find = "SELECT password FROM voter
     where Username = ".$_SESSION['voterID']." AND password = ".$_SESSION['password'].";";
    $result = mysqli_query($conn, $find);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        if($row['password'] === $_POST['confirmPassword']){
            echo '<script>
            $(document).ready(function(){
                Swal.fire({
                    icon: "warning",
                    iconColor: "#E03636",
                    title: "Choose New Password",
                    showConfirmButton: false,
                    timer:1500,                 
                  })
                  .then(function(){
                    window.location.href = "changepass.php" 
                  })
            })       
            </script>';
        }
        else{
            $sql = "UPDATE voter SET password ="."'".$_POST['confirmPassword']."'"."
     where Username = "."'".$_SESSION['password']."'"." AND password = "."'".$_SESSION['password']."'".";";

    $insert = mysqli_query($conn, $sql);

    if ($insert){
        echo '<script>
        $(document).ready(function(){
            Swal.fire({
                icon: "success",
                iconColor: "#30a702",
                title: "Password Changed Successfully",
                showConfirmButton: false,
                timer:1500,                 
              })
              .then(function(){
                window.location.href = "../index.php" 
              })
        })       
        </script>';
    }
    else{
        die($conn);
    }

        }
    }

}


?>


