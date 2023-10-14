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
            <li id="selected">
            <i class="fa-solid fa-gears"></i>
            <a href="Settings.php">Settings</a>
            </li>
        </ul>
    </div>
    <div class="container" id="container">

    <div class="settingsHolder">
        <form action="changeAdminInfo.php" method="POST" onsubmit="return validateInfo()" enctype="multipart/form-data" autocomplete="off">
            <div class="pictureDetails">
                <img src="../pictures/<?php echo $_SESSION['profile']?>" alt="" id="previewPic">
                <div class="des">
                        <label for="updPicture">Choose Photo</label>
                        <input type="file" id="updPicture" style="display: none;" name="photo" onchange="previewPicture()">
                        <label for="removePicture" id="removeBtn">Remove Photo</label>
                        <input type="button" id="removePicture" style="display: none;" value="<?php echo $_SESSION['ID']?>">
                </div>
            </div>
            <div class="infoDetails">
                <div class="detailsTitle">EDIT INFORMATION</div>
                <div class="control">
                    <label for="sName">Surname</label>
                    <input type="text" id="sNameAdmin" name="sNameAdmin" placeholder="Surname" maxlength="15">
                </div>
                <div class="control">
                    <label for="fName">First Name</label>
                    <input type="text" id="fNameAdmin" name="fNameAdmin" placeholder="First Name" maxlength="15">
                </div>
                <div class="control">
                    <label for="mName">Middle Initial</label>
                    <input type="text" id="mNameAdmin" name="mNameAdmin" placeholder="Middle Name" maxlength="2">
                </div>
                <div class="control">
                    <label for="email">Email</label>
                    <input type="text" id="emailAdmin" name="emailAdmin" placeholder="email@gmail.com">
                </div>
                <div class="control">
                    <label for="username">Username</label>
                    <input type="text" id="usernameAdmin" name="usernameAdmin" placeholder="Username">
                </div>
                <div class="control">
                    <label for="curpass">Current Password</label>
                    <input type="password" id="curpassAdmin" name="curpassAdmin" placeholder="Current Password">
                </div>
                <div class="control">
                    <label for="newpass">New Password</label>
                    <input type="password" id="newpassAdmin" name="newpassAdmin" placeholder="New Password">
                </div>
                <div class="control">
                <label for="confpass">Confirm Password</label>
                    <input type="password" id="confpassAdmin" name="confpassAdmin" placeholder="Confirm Password">
                </div>
                <button type="submit" name="submitChange">SAVE  &nbsp;<i class="fa-regular fa-floppy-disk"></i></button>
                
            </div>
        </div>


    </form>
    </div>
</body>
<script>
$(document).ready(function(){
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
                    title: "Logged out Succesfully",
                    showConfirmButton: false,
                    timer:1000,
                      
                  })
                  .then(function(){
                    window.location.href = "../logout.php" 
                  })
                                    
                }
              })

    })
    $.get("defaultValues.php", function(response){
        console.log(response);
      var data = JSON.parse(response); 
                    $('#sNameAdmin').val(data.lName);
                    $('#fNameAdmin').val(data.fName);
                    $('#mNameAdmin').val(data.mName);
                    $('#emailAdmin').val(data.email); 
                    $('#usernameAdmin').val(data.username); 
        }) 
        
        $(document).on("blur", "#usernameAdmin", function(){
            var username = $(this).val();

            $.ajax({              
                method: "POST",
                url: "../username.php",
                data: {username:username},
                success : function(data){
                var state = JSON.parse(data);                       
                if(state.status == 'error'){ 
                    Swal.fire({
                    icon: "error",
                    text: state.input+" Already in Use",
                    showConfirmButton: false,
                    timer:1500,                     
                  })
                  .then(function(){
                    $("#usernameAdmin").val('');
                  })
                } 
                }
            })
        })
        $(document).on("blur", "#curpassAdmin", function(){
            var pass = $(this).val();

            $.ajax({              
                method: "POST",
                url: "validatePassword.php",
                data: {pass:pass},
                success : function(data){
                var state = JSON.parse(data);                       
                
                if(state.status == 'error'){ 
                    Swal.fire({
                    icon: "error",
                    text: "Invalid Current Password",
                    showConfirmButton: false,
                    timer:1500,                     
                  })
                  .then(function(){
                    $("#curpassAdmin").val('');
                  })
                } 
                }
            })
        })
        setInterval(function(){
            $.get("realtimeElection.php", function(data){
                $('#electionTime').html(data);     
            });
        },1000);
        $(document).on("click", "#removeBtn", function(){
             var remove = $("#removePicture").val();
             
             Swal.fire({
                title: "Remove Profile",
                text: "Remove this Photo?",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                icon: "warning",
                iconColor: "#FF2E2E",
                buttons: true,
                dangerMode: true,
              })
              .then ((logout)=>{
                if (logout.isConfirmed){
                $.ajax({
                type: "POST",
                url: "removeAdminPhoto.php",
                data: {remove:remove},
                success: function(){
                    Swal.fire({
                        title: "Updated Successfully",
                        icon: "success",
                        iconColor: "#30a702",
                        showConfirmButton: false,
                        timer: 1000,
                      })
                      .then(function(){
                        window.location.href = "Settings.php" 
                      })
                }
             })
                                    
                }
              })

         })
})
</script>
</html>