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


if(isset($_POST['remove'])){

        $sql = "UPDATE `admin` SET `profile` = 'default.jpg' where AdminID = ".$_POST['remove'].";";

        $insert = mysqli_query($conn, $sql);
        if($insert){
            $sql1 = "SELECT profile FROM `admin` WHERE AdminID = ".$_POST['remove'].";";
            $result = $conn->query($sql1);
            $row = mysqli_fetch_assoc($result);
           
            $_SESSION['profile'] = $row['profile'];
          
        }

        

}



?>
