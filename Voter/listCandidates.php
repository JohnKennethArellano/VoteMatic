<?php
session_start();
include("../conn/connection.php");
if(!isset($_SESSION['userName'])){      
    echo'<script> window.location.href = "../index.php" ;</script>';  
    mysqli_close($conn)   ;  
    exit();
 }



$sql = "SELECT * FROM position WHERE ElectionId =".$_SESSION['eID']." and status != 'deleted' ORDER BY Priority ASC;";
$result = $conn->query($sql);
if($result->num_rows >0){
    while($row = $result->fetch_assoc()){
        echo '            
            <div class="info">
            <span class="position">'.$row['Description'].' <br></span>
            <span class="maxvote">You can choose '.$row['Max_Vote'].' Candidate for this position.</span>
            </div>';
        $query1 = "SELECT profile,CandidateID,Platform, partylist, CONCAT(UPPER(lName),', ',fName , ' ' , mName ) as Name FROM candidate where PositionID =".$row['positionID']." and status = 'active';";
        $result1 = $conn->query($query1);
        if($result1->num_rows > 0 ){
            while($res1 = $result1->fetch_assoc()){
                $query2 = "SELECT * FROM position where positionID =".$row['positionID'].";";
                $result2 = $conn->query($query2);
                $res2 = $result2->fetch_assoc();

                $query3 = "SELECT * FROM partylist where ID =".$res1['partylist'].";";
                $result3 = $conn->query($query3);
                $res3 = $result3->fetch_assoc();

                
                $pos = str_replace(' ', '', $res2['Description']);
                echo '<div class="infoHolder">
                <img src="../pictures/'.$res1['profile'].'" alt=""><br>
                <div class="h">
                <div class="nameHolder">              
                <span class="name">'.$res1['Name'].'</span>               
                </div>
                <div class="partylist">
                    <span class="motto">Platform : "'.$res1['Platform'].'"<br></span>
                    <span class="p">Partylist : "'.$res3['partylistname'].'"</span>
                </div>
                </div>
                <div class="but"> 
                <input type="checkbox" name="'.$pos.'[]" style="display:none ;" class="submitVote" id="'.$res1['CandidateID'].'" value="'.$res1['CandidateID'].'">
                <label class="checkboxLabel" for="'.$res1['CandidateID'].'">Vote </label>              
                </div>
                
                </div>';
                
            }
        }
        else{
            echo '<div class="infoHolder">
            <img src="../pictures/default.jpg" alt=""><br>
            <div class="h">
            <div class="nameHolder">              
            <span class="name">No Candidate for this Position</span>               
            </div>
            <div class="partylist">
                <span class="motto"><br></span>
                <span class="p"></span>
            </div>
            </div>
            <div class="but">              
            </div>
            
            </div>';
        }
    }
}
    
?>









