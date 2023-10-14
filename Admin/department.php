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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="website icon" type="png " href="../pictures/Logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/275edc9f9d.js"></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <script defer src="admin.js"></script>
    <link rel="stylesheet" href="AdminUI.css">
    <title>Elections</title>
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
            <li id="selected">
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
        <div class="vOptions">
            <div class="filter">
                <button id="addDepartment">DEPARTMENT <i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
        <table cellspacing="0" id="head">
            <thead>
                <tr>
                    <td class="dId">ID</td>                   
                    <td class="dName">Department Name</td>
                    <td class="dEdit"></td>
                </tr>
            </thead>
        </table>
        <div class="tableBody" id="tableBody">
        </div>
        <div class="addVoter" id="dform">
<form action="departmentAdd.php" method="POST" onsubmit="return validateDepartment()" autocomplete="off">

                    <div class="regis-title">ADD DEPARTMENT</div>
                    <div class="namewrapper">
                        <div class="namewrapperInput">
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="Department Name" id="depName" name="depName" >
                                <div class="errorMessage"> </div>
                            </div>
                        </div>
                     </div>
                    <div class="actions">
                    <button type="submit" name="addDep" class="crud">Save<i class="fa-regular fa-floppy-disk"></i></button>
                    <button type="button" class="c" id="c1">Cancel</button>
                    </div>
    </form>
</div>
<div class="addVoter" id="editDepartment">
    <form action="departmentEdit.php" method="POST" onsubmit="return validateDepartmentChange()" autocomplete="off">

                    <div class="regis-title">EDIT DEPARTMENT</div>
                    <div class="namewrapper">
                        <div class="namewrapperInput">
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="Department Name" id="depNameEdit" name="depNameEdit" >
                                <div class="errorMessage"> </div>
                            </div>
                        </div>
                     </div>
                    <div class="actions">
                    <button type="submit" name="editDep" class="crud">Save<i class="fa-regular fa-floppy-disk"></i></button>
                    <button type="button" class="c" id="c2">Cancel</button>
                    </div>
    </form>
</div>

    </div>
</body>
<script>
$(document).ready(function(){

    $.get("defDepartment.php", function(data){
        $("#tableBody").html(data);
    })
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
    $(document).on('click', '.deleteBtn',function(){
            var v = $(this).val();
            Swal.fire({
                title: "DELETE",
                text: "Remove this Department ?",
                icon: "warning",
                iconColor: "#F73E3E",
                showCancelButton: true,
                confirmButtonColor: "#F73E3E",
                confirmButtonText: "Remove",
              })       
              .then((remove)=>{
                if (remove.isConfirmed){  
                    $.ajax({
                        type: "POST",
                        url: "departmentDelete.php",
                        data:{dlDepartment: v},
                        success: function(data){  
                            console.log(data);
                            var state = JSON.parse(data);                       
                            console.log(state);
                            if(state.status == 'start'){ 
                                Swal.fire({
                                icon: "error",
                                title:"Election Ongoing",
                                text: "Cannot Delete Department",
                                showConfirmButton: false,
                                timer:1000,                     
                            })
                            }
                            else if(state.status == 'error'){ 
                                Swal.fire({
                                icon: "error",
                                text: "Department in Use",
                                showConfirmButton: false,
                                timer:1000,                      
                            })
                            }
                            else if(state.status == 'success') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Department Deleted",
                                    showConfirmButton: false,
                                    timer:1000                     
                                            })
                                    $.get("defDepartment.php", function(data){
                                            $("#tableBody").html(data);
                                        })  
                            }        
                        }
                            })                           
                }
              })           
        })
        $("#addDepartment").click(function(){
        $("#dform").show();
        $("#editDepartment").hide();
        $("#depName").val('');
         });

         $("#c1").click(function(){
        $("#dform").hide();
         });
         $("#c2").click(function(){
        $("#editDepartment").hide();
         });

         $(document).on("click", ".editBtn",function(){
            var dID = $(this).val();
            $("#editDepartment").show();
            $("#dform").hide();
            $.ajax({
                type:"POST",
                url: "departmentRead.php",
                data: {dID: dID},
                success: function(data){   
                     console.log(data);
                    $('#depNameEdit').val(data);
                   
                }
            })

         });
         setInterval(function(){
            $.get("realtimeElection.php", function(data){
                $('#electionTime').html(data);     
            });
        },1000);
})
</script>
</html>