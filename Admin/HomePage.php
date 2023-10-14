<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }
    $_SESSION['check'] = "created";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png " href="../pictures/Logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&family=Quicksand&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/275edc9f9d.js"></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <script defer src="admin.js"></script>
    <link rel="stylesheet" href="AdminUI.css">
    <title>Home Page</title>
</head>
<body>
    <header>
        <img src="../pictures/LogoOnly.png" alt="">
        <span id="electionTime" style="display: none;"></span>
        <div class="profile">
            <img src="../pictures/<?php echo $_SESSION['profile']?>" >
            <div class="admin">
                <div class="text">
                    <span>Welcome,</span><br>
                    <span><?php echo  $_SESSION['admin'] ?></span>
                </div>
            </div>
        </div>      
       <button type="submit" name="logout" id="logout">
       <span>LOG OUT</span>
       </button>
    </header>

    <div class="menu" id="menu">
        <div class="dashboard">
            <i class="fa-solid fa-bars" id="minimize"></i>
        </div>

        <div class="menus">Reports</div>
        <ul>
            <li id="selected"> 
                <i class="fa-solid fa-square-poll-vertical"></i>
                <a href="HomePage.php">Overview</a>
            </li>
            <li>
                <i class="fa-solid fa-database"></i>
                <a href="Results.php">Results</a>
            </li>
        </ul>
            
        <div class="menus">Manage</div>
        <ul>
            <li>
            <i class="fa-solid fa-people-group"></i>
                <a href="partylist.php">Partylists</a>
            </li>
            <li>
            <i class="fa-solid fa-user-tie"></i>
                <a href="position.php">Positions</a>
            </li>
            <li>
                <i class="fa-sharp fa-solid fa-user-tie"></i>
                <a href="Candidates.php">Candidates</a>
            </li>
            <li>
            <i class="fa-solid fa-building-user"></i>
                <a href="department.php">Department</a>
            </li>
            <li>
                <i class="fa-solid fa-users"></i>
                <a href="Voters.php">Voters</a>
            </li>
            <li>
                <i class="fas fa-file-alt"></i>
                <a href="Elections.php">Elections</a>
            </li>

        </ul>
        <div class="menus">Settings</div>
        <ul>
            <li>
            <i class="fa-solid fa-gears"></i>
            <a href="Settings.php">Settings</a>
            </li>
        </ul>

        </div>

    <div class="container" id="container">
        
        <div class="info">
            <div class="infoContainer" id="position">
                <div class="totalValue">
                    <span class="value" id="posCount">0</span>
                    <span class="pValue">Positions</span>
                </div>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="infoContainer" id="candidate">
                <div class="totalValue">
                    <span class="value" id="canCount">0</span>
                    <span class="pValue">Candidates</span>
                </div>
                <i class="fa-sharp fa-solid fa-user-tie"></i>
            </div>
            <div class="infoContainer" id="department">
                <div class="totalValue">
                    <span class="value" id="depCount">0</span>
                    <span class="pValue">Department</span>
                </div>
                <i class="fa-solid fa-building-user"></i>
            </div>
            <div class="infoContainer" id="voter" >
                <div class="totalValue">
                    <span class="value" id="voterCount">0</span>
                    <span class="pValue">Voters</span>
                </div>
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="infoContainer" id="voted">
                <div class="totalValue">
                    <span class="value" id="votedCount">0</span>
                    <span class="pValue">Total Voted</span>
                </div>
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="result">            
            <div class="division">       
                <div class="totalCandidates" id="totalCandidates">                
                </div>
               
            </div>

            <div class="division">
                <div class="totalVoters" id="totalVoters">
                </div>          
            </div>
            
            <div class="division">
                <div class="totalVotersVoted" id="totalVotersVoted">
                </div>      
                <div id="try"></div>         
            </div>
            
           
          
        </div>
    </div>

</body>
<script>
    $(document).ready(function(){    
            setInterval(function()  {
              $.get("data.php", function(response){         
                var data = JSON.parse(response);
                    $('#posCount').html(data.Description);
                    $('#canCount').html(data.Name);
                    $('#voterCount').html(data.Voter);
                    $('#depCount').html(data.Department);  
                    $('#votedCount').html(data.Voted);  
              });

              $.get('list.php',function(data){
                $('#totalCandidates').html(data);
              });
              
              $.get('list1.php',function(data){
                $('#totalVoters').html(data);  
                    
              });
              $.get('list2.php',function(data){
                $('#totalVotersVoted').html(data);     
                    
              });
              $.get('realtimeElection.php',function(data){
                $('#electionTime').html(data);     
                console.log(data);
              });
            }, 1000);
    
    $(document).on('click', '#logout',function(){
        Swal.fire({
                title: "Log Out?",
                text: "Do you want to Log Out ?",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                icon: "warning",
                iconColor: "#FF2E2E",
                buttons: true,
                dangerMode: true,
              })
              .then ((logout)=>{
                if (logout.isConfirmed){
                    Swal.fire({
                    icon: "success",
                    iconColor: "#30a702",
                    title: "Logged out Successfully",
                    showConfirmButton: false,
                    timer:1000,
                      
                  })
                  .then(function(){
                    window.location.href = "../logout.php" 
                  })
                                    
                }
              })

    })

});
</script>
</html>