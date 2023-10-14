
<?php

session_start();
require("../conn/connection.php");
if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
   echo'<script> window.location.href = "../index.php" ;</script>';
   mysqli_close($conn);
   exit();
}


if(isset($_POST['result'])){

        $sql = "SELECT * from election WHERE ElectionID = ".$_POST['result'].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '<div class="icon">
        <i class="fa-solid fa-trophy"></i>
        </div>';
        echo ' <div class="electionWinnersTitle">Winners for Election '.$row['ElectionName'].'</div>';

        $sql1 = "SELECT * from position WHERE ElectionID = ".$_POST['result']." and status != 'deleted' ORDER BY Priority ASC;";
        $result1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($result) > 0 ){
            while($row1 = mysqli_fetch_assoc($result1)){
                echo '<div class="perPosition">';
                echo '<div class="positionTitle">Winner/s '.$row1['Description'].'</div>';
                $sql2 = "SELECT CandidateID, COUNT(*) as Vote
                FROM voted
                WHERE  pos_id = ".$row1['positionID']."
                GROUP BY CandidateID
                ORDER BY COUNT(*) DESC LIMIT ".$row1['WinnersCount'].";";
                $result2 = mysqli_query($conn, $sql2);

                if(mysqli_num_rows($result2) > 0){
                    
                    while($row2 = mysqli_fetch_assoc($result2)){
                        echo '<div class="infoHolder">';
                        $sql3 = "SELECT profile,CandidateID,Platform, partylist, CONCAT(UPPER(lName),', ',fName , ' ' , mName ) as Name
                        FROM candidate
                        WHERE  CandidateID = ".$row2['CandidateID'].";";
                        $result3 = mysqli_query($conn, $sql3);
        
                        if(mysqli_num_rows($result3) > 0){                           
                            while($row3 = mysqli_fetch_assoc($result3)){

                                $sql4 = "SELECT * FROM partylist WHERE  ID = ".$row3['partylist'].";";
                                $result4 = mysqli_query($conn, $sql4);
                                        
                            if(mysqli_num_rows($result4) > 0){                           
                            while($row4 = mysqli_fetch_assoc($result4)){

                               echo '
                               <img src="../pictures/'.$row3['profile'].'" alt=""><br>
                               <div class="h">
                               <div class="nameHolder">              
                               <span class="name">'.$row3['Name'].' </span>               
                               </div>
                               <div class="partylist">
                                   <span class="motto">Platform : " '.$row3['Platform'].' " <br></span>
                                   <span class="p">Partylist : " '.$row4['partylistname'].' "</span>
                               </div>
                               </div>
                               <div class="totalVote"> 
                                   <span>Total Votes<br></span>             
                                   <span id="count">'.$row2['Vote'].' </span>
                               </div>
                               </div>                            
                               ';
                                
                            }
                           
                        }      
                            }
                            
                            
                        }
                        echo '</div>';
                    }
                    
                    
                }
                else{
                    echo '
                    <div class="infoHolder">
                    <img src="../pictures/default.jpg" alt=""><br>
                    <div class="h">
                    <div class="nameHolder">              
                    <span class="name">No Candidate </span>               
                    </div>
                    </div>
                    <div class="totalVote"> 
                        <span><br></span>             
                        <span id="count"></span>
                    </div>
                    </div>   
                    </div>                         
                    ';
                }
                echo '</div>';
            }
            echo '    <div class="exit">
            <button type="button" class="c2">OK</button>
            </div>';
        }
        
 

}


?>
