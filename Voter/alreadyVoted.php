<?php

session_start();
include("../conn/connection.php");
if(!isset($_SESSION['userName'])){      
    echo'<script> window.location.href = "../index.php" ;</script>';  
    mysqli_close($conn)   ;  
    exit();
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
    <link rel="stylesheet" href="VoterUI.css">
    <link rel="stylesheet" href="otherThings1.css">
    <title>Document</title>
</head>
<body>
<header>
<img src="../pictures/LogoOnly.png" alt="">
        <div class="profile">
            <img src="../pictures/default.jpg" >
            <div class="admin">
                <div class="text">
                    <span>Welcome,</span><br>
                    <span><?php echo  $_SESSION['userName'] ?></span>
                </div>
            </div>
        </div>      
       <button type="submit" name="logout" id="logout">
       <span>LOG OUT</span>
       </button>
    </header>   
    
 <section>
            <h1><span>You already voted for this election.<br></h1>
 </section>   

</body>  
<script>
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
</script>
</html>