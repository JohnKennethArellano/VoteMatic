
<?php
require("../VoteMatic/conn/connection.php");
if(isset($_POST['username'])){

    $query = "SELECT * FROM admin WHERE Username = '".$_POST['username']."' ;";
    $result =mysqli_query($conn, $query);

    if($result->num_rows > 0){
        echo json_encode(array('status' => 'error', 'input' => $_POST['username']));
    }
    
    else{
        echo json_encode(array('status' => 'success'));
    }

}
?>