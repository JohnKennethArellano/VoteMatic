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
    <script src="admin.js" defer></script>
    <link rel="stylesheet" href="AdminUI.css">
    <title>Candidates</title>
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
            <li id="selected">
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
        <div class="vOptions">
            <div class="searchBar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search Candidate" id="sVoter" name="sVoter">
            </div>
            <div class="filter">
                <button id="addCandidate">CANDIDATE <i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
        <table cellspacing="0" id="head">
            <thead>
                <tr>
                    <td class="cId">ID</td>                   
                    <td class="cName">NAME</td>
                    <td class="cPlatform">PLATFORM</td>
                    <td class="cPos">POSITION</td>
                    <td class="cPar">PARTYLIST</td>
                    <td class="cEdit"></td>
                </tr>
            </thead>
        </table>
        <div class="tableBody" id="tableBody">
        </div>
    </div>
    <div class="addVoter" id="cForm">
        <form action="candidateAdd.php" method="POST" onsubmit="return validateCandidate()" autocomplete="off">
        <div class="regis-title">ADD CANDIDATE</div>
                    <div class="namewrapper">
                        <div class="name-userdetails">NAME</div>
                        <div class="namewrapperInput">
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="Surname" id="csName" name="csName" >
                                <div class="errorMessage"></div>
                            </div>
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="First Name" id="cfName" name="cfName" >
                                <div class="errorMessage"> </div>
                             </div>
                             <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="M.I." id="cmName"  name="cmName" maxlength="2">
                                <div class="errorMessage"> </div>
                             </div>
                        </div>
                     </div>
                     <div class="platform">
                        <input type="text" maxlength="30" placeholder="Platform ( Max 30 Characters )" id="cplatform" name="platform">
                     </div>
                     <div class="selHolder">
                       <span>Position</span>
                        <select name="posAve" id="posAvailable"></select>
                     </div>
                     <div class="selHolder">
                        <span>Partylist</span>
                        <select name="parAve" id="parAvailable"></select>
                     </div>
        <div class="actions">
        <button type="submit" name="addCandidate"  class="crud">Save<i class="fa-regular fa-floppy-disk"></i></button>
        <button type="button" class="c" id="c1">Cancel</button>
        </div>
        </form>
    </div>
    <div class="addVoter" id="ceForm">
        <form action="candidateEdit.php" method="POST" onsubmit="return validateChangeCandidate()" enctype="multipart/form-data" autocomplete="off">
        <div class="regis-title">EDIT CANDIDATE</div>
                    <div class="editPicture">
                        <img src="" alt="" id="uploadPreview">
                        <div class="des">
                        <label for="updPic">Choose Photo</label>
                        <input type="file" id="updPic" style="display: none;" name="photo" onchange="PreviewImage()">
                        <label for="remove" id="removeBtn">Remove Photo</label>
                        <input type="button" id="remove" style="display: none;" value="">
                        </div>
                    </div>
                    <div class="namewrapper">
                        <div class="name-userdetails">NAME</div>
                        <div class="namewrapperInput">
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="Surname" id="csNameEdit" name="csName" >
                                <div class="errorMessage"></div>
                            </div>
                            <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="First Name" id="cfNameEdit" name="cfName" >
                                <div class="errorMessage"> </div>
                             </div>
                             <div class="name-form-control"> 
                                <input type="text" class="name-input" placeholder="M.I." id="cmNameEdit"  name="cmName" maxlength="2">
                                <div class="errorMessage"> </div>
                             </div>
                        </div>
                     </div>
                     <div class="platform">
                        <input type="text" maxlength="30" id="cplatformEdit" name="platform">
                     </div>
                     <div class="selHolder">
                       <span>Current Position : <span id="currentPos"></span></span>
                        <select name="posAve" id="posAvailableEdit"></select>
                     </div>
                     <div class="selHolder">
                        <span>Current Partylist : <span id="currentPar"></span></span>
                        <select name="parAve" id="parAvailableEdit"></select>
                     </div>
        <div class="actions">
        <button type="submit" name="editCandidate"  class="crud">Save<i class="fa-regular fa-floppy-disk"></i></button>
        <button type="button" class="c" id="c2">Cancel</button>
        </div>
        </form>
    </div>
    

    </div>

</body>
<script>
$(document).ready(function(){

        $.get("availablePositions.php", function(data){
            $('#posAvailable').html(data);
            $('#posAvailableEdit').html(data);               
        });
        $.get("availablePartylist.php", function(data){
            $('#parAvailable').html(data);
            $('#parAvailableEdit').html(data);              
        });

    $.get("defCandidates.php", function(data){
        $("#tableBody").html(data);
        }) 

        $("#addCandidate").click(function(){
        $("#cForm").show();
        $("#ceForm").hide();
        $("#csName").val('');
         $("#cfName").val('');
         $("#cmName").val('');
         $("#cplatform").val('');
         $("#posAvailable").val('default');
         $("#parAvailable").val('default');
         });

         $("#c1").click(function(){
             $("#cForm").hide();
         });
         $("#c2").click(function(){
             $("#ceForm").hide();
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
    $(document).on('click', '.deleteBtn',function(){
            var v = $(this).val();
            Swal.fire({
                title: "DELETE",
                text: "Remove Candidate "+ v +" ?",
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
                        url: "candidateDelete.php",
                        data:{dlCandidate: v},
                        success : function(data){
                            var state = JSON.parse(data);                       
                console.log(state);
                if(state.status == 'error'){ 
                    Swal.fire({
                    icon: "error",
                    title:"Election Ongoing",
                    text: "Cannot Delete Candidate",
                    showConfirmButton: false,
                    timer:1000,                     
                  })
                }

                  else {
                    Swal.fire({
                        icon: "success",
                        title: "Candidate Deleted",
                        showConfirmButton: false,
                        timer:1000                     
                                })
                        $.get("defCandidates.php", function(data){
                                $("#tableBody").html(data);
                            })  
                }        
                    }
                            })                           
                }
              })           
        });


        $(document).on("click", ".editBtn",function(){
            var cID = $(this).val();
            $("#ceForm").show();
            $("#cForm").hide();


            $.ajax({
                type:"POST",
                url: "candidateRead.php",
                data: {cID: cID},
                success: function(response){   
                    var data = JSON.parse(response); 
                     console.log(data);
                    $('#remove').val(data.ID);
                    $('#csNameEdit').val(data.lName);
                    $('#cfNameEdit').val(data.fName);
                    $('#cmNameEdit').val(data.mName); 
                    $('#uploadPreview').attr("src","../pictures/" + data.picture); 
                    $('#cplatformEdit').val(data.platform); 
                    $('#currentPos').html(data.position); 
                    $('#currentPar').html(data.partylist); 
                   
                }
            })

         });

         $(document).on("click", "#remove", function(){
             var remove = $(this).val();
             
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
                url: "removePhoto.php",
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
                        window.location.href = "Candidates.php" 
                      })
                }
             })
                                    
                }
              })

         })

         $("#sVoter").keyup(function(){
            var search = $(this).val();
            if(search != ""){
                $.ajax({
                    url:"candidateSearch.php",
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
            url:"defCandidates.php",
            success: function(data){                   
                $('#tableBody').html(data);  
            }
            });
            }
        });

        setInterval(function(){
            $.get("realtimeElection.php", function(data){
                $('#electionTime').html(data);     
            });
        },1000);

})

</script>
</html>