<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png " href="../pictures/Logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/275edc9f9d.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <script defer src="admin.js"></script>
    <link rel="stylesheet" href="AdminUI.css">
    <title>Results</title>
</head>
<body>
<header>
        <img src="../pictures/LogoOnly.png" alt="">
        <div class="profile">
        <span id="electionTime" style="display: none;"></span>
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
            <li> 
                <i class="fa-solid fa-square-poll-vertical"></i>
                <a href="HomePage.php">Overview</a>
            </li>
            <li id="selected">
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


    </div>    
    <div class="container" id="container">
        <div class="title">Results for <?php echo $_SESSION['eName']?></div>
        <div class="resWrap" id="resWrap">

        </div>
        
    </div>

</body>
<script>
$(document).ready(function(){
    setInterval(function(){
        $.get("fetchResult.php", function(data){
            $("#resWrap").html(data);
        })
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
    setInterval(function(){
            $.get("realtimeElection.php", function(data){
                $('#electionTime').html(data);     
            });
        },1000);
})
</script>
</html>