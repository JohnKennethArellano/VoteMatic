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
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <script defer src="admin.js"></script>
    <link rel="stylesheet" href="AdminUI.css">
    <title>Voters</title>
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
            <li id="selected">
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
            <div class="searchBar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search Voter" id="sVoter" name="sVoter">
            </div>
            <div class="filter">
                <button id="showForm">VOTER<i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
        <table cellspacing="0" id="head">
            <thead>
                <tr>
                    <td class="vId">VOTER ID</td>
                    <td class="vName">NAME</td>
                    <td class="vDep">DEPARTMENT</td>
                    <td class="edit"></td>
                </tr>
            </thead>
        </table>
        <div class="tableBody" id="tableBody">
        </div>
    </div>

<div class="addVoter" id="vForm">
<form action="voterAdd.php" method="POST" onsubmit="return validateVoter()" autocomplete="off">

                    <div class="regis-title">ADD VOTER</div>
                    <div class="namewrapper">
                        <div class="name-userdetails">NAME</div>
                        <div class="namewrapperInput">
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="Surname" id="sName" name="sName" >
                                <div class="errorMessage"> </div>
                            </div>
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="First Name" id="fName" name="fName" >
                                <div class="errorMessage"> </div>
                             </div>
                             <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="M.I." id="mName"  name="mName" maxlength="2">
                                <div class="errorMessage"> </div>
                             </div>
                        </div>
                     </div>
                    <div class="regis-form-control">
                        <div class="regis-userdetails">Voter ID</div>
                        <div class="genWrap">
                        <input type="text" class="regisID" id="voterID" name="generate" readonly>
                        <button id="gen" type="button">GENERATE</button>
                        </div>
                    
                    <select id="dep" name="dep">                   
                    </select>
                    </div>
                    <div class="actions">
                    <button type="submit" name="addVoter" id="addVoter" class="crud">Save<i class="fa-regular fa-floppy-disk"></i></button>
                    <button type="button" class="c" id="c1">Cancel</button>
                    </div>
    </form>
</div>
<div class="addVoter" id="updateVoter">
<form action="voterUpdate.php" method="POST" onsubmit="return validateChange()" autocomplete="off">
                    <div class="regis-title">Update Details </div>
                    <div class="namewrapper">
                        <div class="name-userdetails">NAME</div>
                        <div class="namewrapperInput">
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="Surname" id="vtsName" name="sName" >
                                <div class="errorMessage"> </div>
                            </div>
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="First Name" id="vtfName" name="fName" >
                                <div class="errorMessage"> </div>
                             </div>
                             <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="M.I." id="vtmName"  name="mName" maxlength="2">
                                <div class="errorMessage"> </div>
                             </div>
                        </div>
                     </div>
                    <div class="regis-form-control">
                    <div class="name-userdetails" id="depname">Department</div>
                    <div class="genWrap"> 
                        <input id="vtDep" readonly>
                    </div>
                    <div class="name-userdetails" id="depname">New Department</div>
                    <select id="dept" name="dep">                   
                    </select>
                    </div>
                    <div class="actions">
                    <button type="submit" name="editVoter" id="update" class="crud">Save<i class="fa-regular fa-floppy-disk"></i></button>
                    <button type="button" class="c" id="c2">Cancel</button>
                    </div>
    </form>
</div>
</body>

<script>
$(document).ready(function(){   
    Swal.fire({
        icon: "warning",
                        title: "NOTE!",
                        iconColor: "#F73E3E",
                        text: "Don't forget to provide your voters their VOTER ID and use it as USERNAME and PASSWORD to vote.", 
                        showConfirmButton: false,
                        timer:4000                     
                })
        $.get("defVoters.php", function(data){
        $("#tableBody").html(data);
        }) 
        
        $.get("departmentData.php", function(data){
            $('#dep').html(data); 
            $('#dept').html(data); 
        });
        $(document).on('click', '.deleteBtn',function(){
            var v = $(this).val();
            Swal.fire({
                title: "DELETE",
                text: "Remove Voter "+ v +" ?",
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
                        url: "voterDelete.php",
                        data:{dlVoter: v},
                        success: function(data){  
                            console.log(data);
                            var state = JSON.parse(data);                       
                            console.log(state);
                            if(state.status == 'start'){ 
                                Swal.fire({
                                icon: "error",
                                title:"Election Ongoing",
                                text: "Cannot Delete Voter",
                                showConfirmButton: false,
                                timer:1000,                     
                            })
                            }
                            else if(state.status == 'success') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Voter Deleted",
                                    showConfirmButton: false,
                                    timer:1000                     
                                            })
                                    $.get("defVoters.php", function(data){
                                            $("#tableBody").html(data);
                                        })  
                            }        
                        }
                            })                           
                }
              })           
        });

        $("#sVoter").keyup(function(){
            var search = $(this).val();
            if(search != ""){
                $.ajax({
                    url:"searchVoter.php",
                    type:"POST",
                    data:{search:search},
                    success: function(data){
                        $('#tableBody').html(data); 

                    }
                })
            }
            else{
            $.ajax({
            type: "POST",
            url:"defVoters.php",
            success: function(data){                   
                $('#tableBody').html(data);  
                console.log(data);
            }
            });
            }
        });

        $("#showForm").click(function(){
        $("#vForm").show();
        $("#updateVoter").hide();
         });
         
         $("#c1").click(function(){
             $("#vForm").hide();
             $("#sName").val('');
             $("#fName").val('');
             $("#mName").val('');
             $("#voterID").val('');
             $("#dep").val('default');
         });
         $("#c2").click(function(){
             $("#updateVoter").hide();
         });

         $(document).on("click", ".editBtn",function(){
            var vID = $(this).val();
            $("#updateVoter").show();
            $("#vForm").hide();

            $.ajax({
                type:"POST",
                url: "voterReadData.php",
                data: {vID: vID},
                success: function(response){
    
                    var data = JSON.parse(response); 
                     console.log(data);
                    $('#vtsName').val(data.lName);
                    $('#vtfName').val(data.fName);
                    $('#vtmName').val(data.mName); 
                    $('#vtDep').val(data.DepartmentID); 
                }
            })

         });

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
    $('#gen').click(function(){
           var number = 1 + Math.floor(Math.random() * 999999);
           $("#voterID").val(number);
            $.ajax({
            type: "POST",
            url:"checkId.php",
            data:{number:number},
            success: function(data){  
                var state = JSON.parse(data);                       
                console.log(state);
                if(state.status == 'error'){ 
                    Swal.fire({
                    icon: "error",
                    title:number,
                    text: "ID Already in Use",
                    showConfirmButton: false,
                    timer:1500,                     
                  })
                  .then(function(){
                    $("#voterID").val(' ');
                  })
                }

                  else {
                    Swal.fire({
                    icon: "success",
                    iconColor: "#30a702",
                    title:number,
                    text: "Generated Successfully",
                    showConfirmButton: false,
                    timer:1500,                      
                  })
                }                      
            }           
        });
    })
    
    setInterval(function(){
            $.get("realtimeElection.php", function(data){
                $('#electionTime').html(data);     
            });
        },1000);


        
        
    });
</script>
</html>