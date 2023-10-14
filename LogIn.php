<head>
    <script src="./scripts/jquery.js"></script>
    <script src="./scripts/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();

include "./conn/connection.php";
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn,$_POST['nameLogIn']);
    $pass = mysqli_real_escape_string($conn,$_POST['passwordLogIn']);
    
    $_SESSION['user'] = $_POST['nameLogIn'];
    $_SESSION['pass'] = $_POST['passwordLogIn'];
    
    $_SESSION['check'] = "check";

    $sql = "SELECT AdminID, Password, profile, CONCAT(UPPER(Surname),', ',FirstName ) as Name FROM `admin` WHERE Username = '$username' AND Password = '$pass';";
    $result = $conn->query($sql);


        if($result->num_rows > 0){  
            $row = $result->fetch_assoc();
            $_SESSION['ID']= $row['AdminID'];
            $_SESSION['admin'] = $row['Name']; 
            $_SESSION['password'] = $row['Password'];
            $_SESSION['profile'] = $row['profile'];

            $election = "SELECT * FROM election WHERE Admin_ID = ". $row['AdminID'] . " and status = 'active';";
            $findElection = $conn->query($election);
            if($findElection->num_rows > 0){
                $erow = mysqli_fetch_assoc($findElection);
                $_SESSION['eID'] = $erow['ElectionID'];
                $_SESSION['eName'] = $erow['ElectionName'];
                echo '<script>
                $(document).ready(function(){
                    Swal.fire({
                        title: "Log In Successful",
                        icon: "success",
                        iconColor: "#30a702",
                        showConfirmButton: false,
                        timer: 1000,
                    })
                    .then(function(){
                        window.location.href = "Admin/HomePage.php" 
                      })
                                           
                });       
            </script>';
            }

            else
            {
              $election = "SELECT * FROM election WHERE Admin_ID = ". $row['AdminID'] . " and status = 'ended';";
              $findElection = $conn->query($election);

                if(mysqli_num_rows($findElection) > 0){
                  echo '
                  <script>
  
                  $(document).ready(function(){
                      Swal.fire({
                          title: "Log In Successful",
                          icon: "success",
                          iconColor: "#30a702",
                          showConfirmButton: false,
                          timer: 1000,
                        })
                        .then(function(){
                          window.location.href = "Admin/createNewElection.php" 
                        })
                  });
                  </script>
                  ';
                }
                else{
                  
                  echo '
                  <script>
  
                  $(document).ready(function(){
                      Swal.fire({
                          title: "Log In Successful",
                          icon: "success",
                          iconColor: "#30a702",
                          showConfirmButton: false,
                          timer: 1000,
                        })
                        .then(function(){
                          window.location.href = "Admin/Empty.php" 
                        })
                  });
                  </script>
                  ';
                }
            }



            }

        else 
                {
                $sql1 = "SELECT ElectionID,VoterID,Username,password, status, DepartmentID, CONCAT(UPPER(lName),', ',fName,' ', mName ) as Name FROM `voter` WHERE Username = '$username' AND password = '$pass';";
                $result1 = $conn->query($sql1);

                
                  
                if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
                $_SESSION['userName'] = $row1['Name'];
                $_SESSION['voterID'] = $row1['VoterID'];
                $_SESSION['eID'] = $row1['ElectionID'];
                $_SESSION['depID'] = $row1['DepartmentID'];
                $_SESSION['password'] = $row1['password'];

                $voted = 'voted' ;
                $deleted = 'deleted';
                $active = 'active';

                $status = $row1['status'];

                    if($row1['VoterID'] === $username && $username === $pass){

                        echo '<script>   
                        $(document).ready(function(){
                            Swal.fire({
                                title: "Log In Successful",
                                icon: "success",
                                iconColor: "#30a702",
                                showConfirmButton: false,
                                timer: 1000,
                              })
                              .then(function(){
                                window.location.href = "Voter/changepass.php" 
                              })
                        });
                        </script>
                        ';
                    }
                    else{


                            date_default_timezone_set('Asia/Manila');
                            $date = date('Y-m-d H:i:s');
                            $date = strtotime($date);
    
                            $fndlctn = "SELECT * FROM election where ElectionID = ".$row1['ElectionID'].";";
                            $res = mysqli_query($conn,$fndlctn);
    
                            if(mysqli_num_rows($res) > 0){
                                $r = mysqli_fetch_assoc($res);
                                $_SESSION['ElectionName'] = $r['ElectionName'];
    
                                $start = strtotime($r['Start']);
                                $end = strtotime($r['End']);
    
                                if ($date - $start < 0 && $date - $end < 0){
                                        echo '
                                        <script>                
                                        $(document).ready(function(){
                                            Swal.fire({
                                                title: "Log In Successful",
                                                icon: "success",
                                                iconColor: "#30a702",
                                                showConfirmButton: false,
                                                timer: 1000,
                                              })
                                              .then(function(){
                                                window.location.href = "Voter/electionStart.php" 
                                              })
                                        });
                                        </script>
                                        ';
                                    }
                                    else if($date - $start > 0 && $date - $end < 0)
                                    {
                                        if($status === $voted){
                                            echo '
                                            <script>
                        
                                            $(document).ready(function(){
                                                Swal.fire({
                                                    title: "Log In Successful",
                                                    icon: "success",
                                                    iconColor: "#30a702",
                                                    showConfirmButton: false,
                                                    timer: 1000,
                                                  })
                                                  .then(function(){
                                                    window.location.href = "Voter/alreadyVoted.php" 
                                                  })
                                            });
                                            </script>
                                            ';
                                              
                                        }
                                        elseif ($status === $deleted){
                                            echo '
                                            <script>
                                            $(document).ready(function(){
                                                Swal.fire({
                                                    icon: "error",
                                                    iconColor: "#FF2E2E",
                                                    title: "Log In Failed!",
                                                    text:"Username or Password is Incorrect",
                                                    showConfirmButton: false,
                                                    timer: 1000,
                                                  })
                                                  .then(function(){
                                                    window.location.href = "index.php" 
                                                  })
                                            });
                                            </script>
                                            ';
                                        }
                                        else{
                                            echo '
                                            <script>
                        
                                            $(document).ready(function(){
                                                Swal.fire({
                                                    title: "Log In Successful",
                                                    icon: "success",
                                                    iconColor: "#30a702",
                                                    showConfirmButton: false,
                                                    timer: 1000,
                                                  })
                                                  .then(function(){
                                                    window.location.href = "Voter/HomePageVoter.php" 
                                                  })
                                            });
                                            </script>
                                            ';
                                        }
                                        
                                    }
                                    else if ($date - $start > 0 && $date - $end > 0)
                                    {
                                        echo '
                                        <script>
                    
                                        $(document).ready(function(){
                                            Swal.fire({
                                                title: "Log In Successful",
                                                icon: "success",
                                                iconColor: "#30a702",
                                                showConfirmButton: false,
                                                timer: 1000,
                                              })
                                              .then(function(){
                                                window.location.href = "Voter/electionEnded.php" 
                                              })
                                        });
                                        </script>
                                        ';
                                    }
                            }                       
                    }
                }
                else
                {   
                    echo '
                    <script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: "error",
                            iconColor: "#FF2E2E",
                            title: "Log In Failed!",
                            text:"Username or Password is Incorrect",
                            showConfirmButton: false,
                            timer: 1000,
                          })
                          .then(function(){
                            window.location.href = "index.php" 
                          })
                    });
                    </script>
                    ';
                }
            }
        }
mysqli_close($conn);
?>