<head>
    <script src="./scripts/jquery.js"></script>
    <script src="./scripts/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="style.css">
</head>
<?php


include "./conn/connection.php";


if(isset($_POST['register'])){


        $sName = mysqli_real_escape_string($conn,$_POST['sName']);
        $sName  = ucfirst($sName);
        $fName = mysqli_real_escape_string($conn,$_POST['fName']);
        $fName  =ucfirst($fName);
        $mName = mysqli_real_escape_string($conn,$_POST['mName']);
        $mName = strtoupper($mName);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password1']);

        $sql = "INSERT INTO `admin` (`Surname`, `FirstName`, `MI`, `email`, `Username`, `Password`, `profile`) VALUES
         ('$sName', '$fName', '$mName', '$email', '$username', '$password', 'default.jpg');";

        $insert = mysqli_query($conn, $sql);

        if($insert){
                echo '
                <script>

                $(document).ready(function(){
                    Swal.fire({
                        title: "Registered Successfully",
                        icon: "success",
                        iconColor: "#30a702",
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
                die($conn);
        }
}



?>
