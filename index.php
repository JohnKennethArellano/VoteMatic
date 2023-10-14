<?php
require("./conn/connection.php");


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
    <link rel="website icon" type="png " href="./pictures/Logo.png">
    <script src="./scripts/jquery.js"></script>
    <script src="./scripts/sweetalert.min.js"></script>
    <title>Vote Matic</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body class="body" id="body">

    <header class="header" id="header">
        <img src="./pictures/Logo.png" alt="">
            <div class="options" id="options">
                    <ul>
                        <li><a href="#section1" id="home">HOME</a></li>
                        <li><a href="#section3" id="about">ABOUT US</a></li>
                        <li><a href="#section4">CONTACT US</a></li>
                        
                    </ul>
             </div>
             <button class="id" id="id"><div id="ball"></div>
        <button id="login-btn"><a href="#">LOG IN</a></button>
    </header>
    <section class="section1" id="section1">

        <div class="f-logo" id="f-logo">
            <span>Online Voting Platform</span>
            <p >Votematic provides a secure voting system and a wide range of services to create any type of election, 
                ensuring efficiency and integrity in every step of the election process.
            </p>
            <button id="voteNow">GET STARTED!</button>
        </div>
        <div class="login-register" id="login-register">
        <div class="container" id="container">
            <div class="front" id="front">
                <form action="LogIn.php" method="POST" onsubmit="return ValidateLogIn()" autocomplete="off">
                    <div class="title">LOG IN</div>
                    <ion-icon name="exit" id="close"></ion-icon>
                    <div class="form-control">
                        <div class="userdetails">ID</div>
                        <input type="text" class="input" placeholder="ID" name="nameLogIn" id="usernameLogIN">
                        <div class="errorMessage"></div>
                    </div>
                    <div class="form-control">
                        <div class="userdetails">PASSWORD</div>
                        <input type="password" class="input" id="pass" placeholder="Password" name="passwordLogIn">
                        <ion-icon name="eye" class="eye" id="loginID" ></ion-icon>
                        <div class="errorMessage"></div>
                    </div>
                    <button type="submit" name="login">LOG IN</button>
                </form>

                <div class="register" id="register"><span>Don't have an Account ?</span> <a href="#">REGISTER</a></div>
            </div>
            <div class="back" id="back">
                <form action="register.php"  method="POST" onsubmit="return Validate()" enctype="multipart/form-data" autocomplete="off">
                    <div class="regis-title">REGISTRATION</div>
                    <ion-icon name="exit" id="close1"></ion-icon>

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



                    <div class="wrapper">
                    <div class="regis-form-control">
                        <div class="regis-userdetails">USERNAME</div>
                        <input type="text" class="regis-input" placeholder="Username" id="username" name="username" >
                        <div class="errorMessage"></div>
                    </div>
                    <div class="regis-form-control">
                        <div class="regis-userdetails">EMAIL</div>
                        <input type="text" class="regis-input" placeholder="@gmail.com" id="email" name="email" >
                        <div class="errorMessage"></div>
                    </div>
                    <div class="regis-form-control">
                        <div class="regis-userdetails">PASSWORD</div>
                        <input type="password" class="regis-input" placeholder="Password" id="password" name="password1" >
                        <div class="errorMessage"></div>
                    </div>
                    <div class="regis-form-control">
                        <div class="regis-userdetails">CONFIRM PASSWORD</div>
                        <input type="password" class="regis-input" placeholder="Confirm Password" id="confirmPass" name="cPassword" >
                        <div class="errorMessage"></div>
                    </div>
                    </div>
                    <button type="submit" name="register" >REGISTER</button>
                </form>
                <div class="login" id="login"><span>Already have an Account ?</span> <a href="#">LOG IN</a></div>
            </div>
        </div>
        </div>

    </section>

    <section id="section2">
        <div class="featureTitle" id="featureTitle">FEATURES</div>
        <div class="holder">
            <div class="features" id="feat1">
                <ion-icon name="lock-closed-outline" class="featIcon"></ion-icon>
                <span>Privacy</span>
                <p>Security measures such as encryption methods are implemented to keep your data, elections, and ballots safe.</p>               
            </div>
            <div class="features" id="feat2">
                <ion-icon name="accessibility" class="featIcon"></ion-icon>
                <span>User-Friendly</span>
                <p>It’s designed to be easily navigated, learned, and used.</p>  
            </div>
            <div class="features" id="feat3">
                <ion-icon name="pie-chart" class="featIcon"></ion-icon>
                <span>Result Tabulation</span>
                <p>Election admins can see real-time results presented in graphs while its voters can see the result at the end of the election.</p>  
            </div>
            <div class="features" id="feat4">
                <ion-icon name="logo-stackoverflow" class="featIcon"></ion-icon>
                <span>Manageable</span>
                <p> Election admins can manage election details and its voters while voters can manage their account like passwords. </p>  
            </div>
            <div class="features" id="feat5">
                <ion-icon name="timer-outline" class="featIcon"></ion-icon>
                <span>Election Schedules</span>
                <p>In creating elections, admins can set a specific date and time for the start and end of their election.</p>  
            </div>
            <div class="features" id="feat6">
                <ion-icon name="person-circle-outline" class="featIcon"></ion-icon>
                <span>Candidate/s Profiles </span>
                <p>Admins can add the candidates’ party list and their main platforms.</p>  
            </div>
    </div>
    </section>

    <section id="section3">
        <div class="aboutUs">
        <div class="info-container" id="info-container">
            <div class="info" id="kenneth">
                <div class="img-holder">
                    <img src="./pictures/Kenneth.png" alt="">
                </div>
                <div class="name">
                    <span>John Kenneth Arellano</span>
                    <div class="role">FRONT END DEVELOPER</div>
                    <div class="role">BACK END DEVELOPER</div> 
                    <button><a href="https://mail.google.com/mail/?view=cm&fs=1&to=johnkenneth.arellano.r@bulsu.edu.ph">GET IN TOUCH</a></button>
                </div> 
               
            </div>
            <div class="info" id="ashley">
                <div class="img-holder">
                    <img src="./pictures/Ashley.jpg" alt="">
                </div>
                <div class="name">
                    <span>Ashley Mickaela Tuya</span>
                    <div class="role">FRONT END DEVELOPER</div>
                    <div class="role">SYSTEM ANALYST</div>
                    <button><a href="https://mail.google.com/mail/?view=cm&fs=1&to=ashleymickaela.tuya.c@bulsu.edu.ph">GET IN TOUCH</a></button>
                </div>
                
            </div>
            <div class="info" id="james">
                <div class="img-holder">
                    <img src="./pictures/James.jpg" alt="">
                </div>
                <div class="name">
                    <span>James Vincent Caluag</span>
                    <div class="role">FRONT END DEVELOPER</div>
                    <div class="role">BACK END DEVELOPER</div>
                    <button><a href="https://mail.google.com/mail/?view=cm&fs=1&to=jamesvincent.caluag.m@bulsu.edu.ph">GET IN TOUCH</a></button>
                </div>
            </div>
            <div class="info" id="sean">
                <div class="img-holder">
                    <img src="./pictures/sean.png" alt="">
                </div>
                <div class="name">
                    <span>Sean Andrew Meulio</span>
                    <div class="role">FRONT END DEVELOPER</div>
                      <div class="role">DATABASE ENGINEER</div>
                    <button><a href="https://mail.google.com/mail/?view=cm&fs=1&to=seanandrew.meulio.c@bulsu.edu.ph">GET IN TOUCH</a></button>
                </div>
            </div>
            <div class="info" id="ally">
                <div class="img-holder">
                    <img src="./pictures/ally.jpg" alt="">
                </div>
                <div class="name">
                    <span>Alessandra Juan</span>
                    <div class="role">FRONT END DEVELOPER</div>
                    <div class="role">SYSTEM ANALYST</div>
                    <button><a href="https://mail.google.com/mail/?view=cm&fs=1&to=alessandra.juan.s@bulsu.edu.ph">GET IN TOUCH</a></button>
                </div>  
            </div>
        </div>
         </div>
         <div class="aboutUs-Company" id="aboutUs-Company" >
            <div class="info-company"id="info-company">ABOUT US</div>
            <div class="aboutUsInfo">
            &emsp; The team started VoteMatic as they wanted to lessen the costs of buying materials such as printing ballots, avoid result inaccuracies due to manual counting, and let people cast their votes anytime within the set election schedule.<br><br>
            &emsp; That’s why we are working hard to develop a system that provides you an efficient and secure way of both voting and running your own elections within your organizations or schools. 
            </div>
         </div>
    </section>
    
    <section id="section4"> 
        <div class="feedback-container" id="feedback-container">
    </div>
    <div class="submitFeedback">
        <div class="feedbackMessage">
            <span>Feedback</span>
            <textarea placeholder="Write your feedback here" required name="message" id="message"></textarea>
            <button class="feedback-Button" id="feedback-Button" name="feedback">Submit</button>
        </div>
    </div>
    <div class="footer-container" id="footer-container">
        <ul>
            <li>
                <div class="logoOnly">
                    <img src="./pictures/Logo.png" alt="">
                </div>
                <div class="logo"></div>
                <div class="socialMedia">
                    <ion-icon name="logo-facebook" class="sLogo" id="fb"></ion-icon>
                    <ion-icon name="logo-instagram" class="sLogo" id="ig"></ion-icon>
                    <ion-icon name="logo-twitter" class="sLogo" id="tw"></ion-icon>
                </div>

                
            </li>
            <li>
                <p>Some Links</p>
                <a href="">F.A.Q</a>
                <a href="">Cookies Policy</a>
                <a href="">Terms and Conditions</a>
                <a href="">Support</a>
            </li>
            <li>
                <p>Contact Us</p>
                <a href="">+63 - 9123456789</a>
                <a href="">+63 - 9987654321</a>
                <a href="">votematic@votematic.com</a>
                <a href="">votematic1@votematic.com</a>
            </li>
        </ul>
    </div>
    
</section>
    
</body>
<script>
    $(document).ready(function(){
        setInterval(function(){
            $.get("Feedback.php", function(data){
            $("#feedback-container").html(data);
        }) 
        },1000);

        $(document).on('click', '#feedback-Button',function(){
            var v = $("#message").val();
            if(v === ''){
                Swal.fire({
                    icon: "warning",
                    title: "Empty Message",
                    showConfirmButton: false,
                    timer:1000,                     
                  })
                return false;
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "feedback.php",
                    data:{feedback: v},
                    success : function(){
                    Swal.fire({
                    icon: "success",
                    title: "Thank You!",
                    showConfirmButton: false,
                    timer:1000                                 
                  })
                  .then(function(){
                    $("#message").val('');
                    })   
                    }
                  }) 
            }
        
        });

        $(document).on("blur", "#username", function(){
            var username = $(this).val();

            $.ajax({              
                method: "POST",
                url: "username.php",
                data: {username:username},
                success : function(data){
                var state = JSON.parse(data);                       
                console.log(state);
                if(state.status == 'error'){ 
                    Swal.fire({
                    icon: "error",
                    text: state.input+" Already in Use",
                    showConfirmButton: false,
                    timer:1500,                     
                  })
                  .then(function(){
                    $("#username").val('');
                  })
                } 
                }
            })
        })


    })
</script>
</html>