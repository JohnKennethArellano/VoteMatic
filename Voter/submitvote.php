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

    if(isset($_POST['vote'])){
        if(count($_POST) == 1){
            echo '
            <script>
            $(document).ready(function(){
                Swal.fire({
                    icon: "warning",
                    iconColor: "#FF2E2E",
                    title: "Please Vote Atleast 1 Candidate",
                    showConfirmButton: false,
                    timer: 1500,
                  })
                  .then(function(){
                    window.location.href = "HomePageVoter.php" 
                  })
            });
            </script>
            ';
		}

        else{
            $id = $_SESSION['eID'];    
            $vid = hash('md5',$id);

            $sql = "SELECT * FROM position where ElectionID = ".$_SESSION['eID']." ORDER BY Priority ASC;";
            $error = false;
            $res = mysqli_query($conn, $sql);

            $sql_array = array();

            while($row = mysqli_fetch_assoc($res)){
                $position = str_replace(' ', '', $row['Description']);
                $positionID = $row['positionID'];
                if(isset($_POST[$position])){
                        if(count($_POST[$position]) > $row['Max_Vote']){
                            $error = true;
                            echo '
                            <script>
                            $(document).ready(function(){
                                Swal.fire({
                                    icon: "warning",
                                    iconColor: "#FF2E2E",
                                    title: "Only '.$row['Max_Vote'].' for '.$row['Description'].'",
                                    showConfirmButton: false,
                                    timer: 1500,
                                  })
                                  .then(function(){
                                    window.location.href = "HomePageVoter.php" 
                                  })
                            });
                            </script>
                            ';
                                      
                        }
                        else{
                            foreach($_POST[$position] as $key => $values ){
                                $sql_array[] = "INSERT INTO voted (ID, VoterID, ElectionID, CandidateID, pos_id, DepartmentID) VALUES
                                ('NULL',"."'".$vid."'".",".$_SESSION['eID'].",".$values.",".$positionID.",".$_SESSION['depID'].")";                                
                            }
                        }                
                }
            }
                
            if(!$error){
                foreach($sql_array as $sql_row){
                    $conn->query($sql_row);
                     }
                     $query = "UPDATE voter SET status = 'voted' WHERE VoterID = ". $_SESSION['voterID'].";";
                     $result =$conn->query($query);
                     echo '
                     <script>
                     $(document).ready(function(){
                         Swal.fire({
                             icon: "success",
                             iconColor: "#30a702",
                             title: "Vote Submitted",
                             showConfirmButton: false,
                             timer: 1500,
                           })
                           .then(function(){
                             window.location.href = "afterVoting.php" 
                           })
                     });
                     </script>
                     ';
            }
                

        }
       
    }

?>

