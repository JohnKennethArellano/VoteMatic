
<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }

if(isset($_POST['dlCandidate'])){

    $sid = $_POST['dlCandidate'];

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
            echo json_encode(array('status' => 'error'));
        }
        else {
            
            $query = "UPDATE candidate SET status = 'deleted' WHERE CandidateID = ".$sid.";";
            $result =$conn->query($query);

            if($result == true){
                echo json_encode(array('status' => 'success'));
            }
        }
    
    }


}

?>