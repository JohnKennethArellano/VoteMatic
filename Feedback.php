<head>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="style.css">
</head>
<?php

require "./conn/connection.php";

$feedback = "SELECT * FROM `feedback` ;";
$mes = $conn->query($feedback);

if($mes->num_rows >0){
    while($row = $mes->fetch_assoc()){
?>
<div class="feedback">
<div class="message">"<?php echo $row['Message'];?>"</div>
<div class="dateTime"><?php echo $row['DateTime'];?></div>
</div>
<?php 
}
}
?> 

<?php
if(isset($_POST['feedback'])){
    $message = mysqli_real_escape_string($conn, $_POST['feedback']);

    $sql = "INSERT INTO `feedback` (`ID`, `Message`, `DateTime`) VALUES (NULL, '$message', current_timestamp());";

   $insert = mysqli_query($conn, $sql);

   if($insert){
    echo '<script> alert("Hi"); </script> ';

    }
    else{
        die($conn);
    }


}


?>