

<?php
session_start();
require("../conn/connection.php");
if(isset($_POST['pass'])){

    $query = "SELECT * FROM admin WHERE AdminID = '".$_SESSION['ID']."' and Password = '".$_POST['pass']."' ;";
    $result =mysqli_query($conn, $query);

    if($result->num_rows > 0){
        echo json_encode(array('status' => 'success'));
    }
    
    else{
        echo json_encode(array('status' => 'error'));
    }

}
?>