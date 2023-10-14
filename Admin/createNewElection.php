<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }
    else if($_SESSION['check'] !== "check"){      
        echo'<script> window.location.href = "../index.php" ;</script>';
     }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&family=Quicksand&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/275edc9f9d.js"></script>
    <link rel="website icon" type="png" href="../pictures/logoOnly.png">
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <script defer src="admin.js"></script>
    <link rel="stylesheet" href="AdminUI.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="learnMoreStyle.css">
    <title>Home Page</title>
</head>
<body>
<header>
        <img src="../pictures/LogoOnly.png" alt="">
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
    <div class="content">   
    <h1 id="WT1" >Welcome to VoteMatic!</h1>
    <p id="WT2">Your Recent Election has Already Ended!</p>

    <div id="cform">
    <div id="closeBan2"><i class="fas fa-times"></i></div>
        <div><h5>Create Election</h5></div>
    <form method="POST" action="createAnotherElection.php" id="myForm" autocomplete="off">
    <label for="electionName">Election Name</label></br>
    <input type="text" name="electionName" placeholder="Ex. Student Government Election" id="electionName"></br>
    <label for="staTime">Election starts at</label></br>
    <input type="datetime-local" name="staTime" id="staTime"></br>
    <label for="stoTime">Election stops at</label></br>
    <input type="datetime-local" name="stoTime" id="stoTime"></br>
    <input id="buttonCreate" type="submit" name="create" value="Create">
    </form>
    </div>
        <div class="button">
        <button id="create"><i class="fa fa-plus-square-o"></i>&nbsp;Create New Election</button>
        </div>
    </div>

    <div class="recentElection">
        <div class="endedTitle" id="recent">Recent Election</div>
        <div class="recent" id="recentElection">
        </div>
    </div>
    <div class="addVoter" id="viewResult">
     <div class="posWinner" id="posWinner">
     </div>   

    </div>

</body>

</html>
<script>
$(document).ready(function(){
$("#cform").hide();
const WT1 = document.getElementById('WT1');
const WT2 = document.getElementById('WT2');
const LMT = document.getElementById('LMT');
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

$("#help").click(function(){
    LMT.innerText="Learn More";
    $("#cform").hide();
    $("#banner").show();
  
    
})

$("#closeBan1").click(function(){
    LMT.innerText="";
    $("#banner").hide();
})

$("#closeBan2").click(function(){
    $("#cform").hide();
   
})


$("#create").click(function(){
    $("#banner").hide();
$("#cform").show();
})


$("#myForm").submit(function(){
    const today = new Date().toLocaleString("en-US", {timeZone: "Asia/Manila"});
    var d = Date.parse(today);
   
    
    var election = $("#electionName").val();
    var staTime = $("#staTime").val();
    var stoTime = $("#stoTime").val();
    

    var date1 = new Date(staTime).toLocaleString("en-US", {timeZone: "Asia/Manila"});
    var e = Date.parse(date1);
    var date2 = new Date(stoTime).toLocaleString("en-US", {timeZone: "Asia/Manila"});
    var f = Date.parse(date2);


    

    if (election === ""){
        Swal.fire({
        title: "Empty Election Name",
        icon: "warning",
        showConfirmButton: false,
        timer: 1000,
        })
        return false;
    }
    if (staTime === ""){
        Swal.fire({
        title: "Start Time Empty",
        icon: "warning",
        showConfirmButton: false,
        timer: 1000,
        })
        return false;
    }
    if(e - d < 0){
        Swal.fire({
        title: "Invalid Start Time",
        icon: "warning",
        showConfirmButton: false,
        timer: 1000,
        })
        return false;
    }
    if (stoTime === ""){
        Swal.fire({
        title: "End Time Empty",
        icon: "warning",
        showConfirmButton: false,
        timer: 1000,
        })
        return false;
    }
    if(f - e < 0){
        Swal.fire({
        title: "Invalid End Time",
        icon: "warning",
        showConfirmButton: false,
        timer: 1000,
        })
        return false;
    }
    else{
       this.submit();       
    }
    
})
    $.get("recentElection.php", function(data){
        $("#recentElection").html(data);
        console.log(data);
    })

    $(document).on('click', '.viewResult', function(){
        $("#viewResult").show();

        var result = $(this).val();
        $.ajax({
                type:"POST",
                url: "recentElectionData.php",
                data: {result: result},
                success: function(data){
    
                     console.log(data);
                     $("#posWinner").html(data);

                }
            })
    })
    $(document).on('click', '.c2', function(){
             $("#viewResult").hide();
         });

    })
</script>