<head>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="AdminUI.css">
</head>
<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


if(isset($_POST['submitChange'])){


  $image = $_FILES['photo']['name'];
  $size = $_FILES['photo']['size'];
  $tempName = $_FILES['photo']['tmp_name'];

  $sName = mysqli_real_escape_string($conn,$_POST['sNameAdmin']);
  $sName  = ucfirst($sName);
  $fName = mysqli_real_escape_string($conn,$_POST['fNameAdmin']);
  $fName  =ucfirst($fName);
  $mName = mysqli_real_escape_string($conn,$_POST['mNameAdmin']);
  $fName  =ucfirst($fName);
  $email = mysqli_real_escape_string($conn,$_POST['emailAdmin']);
  $newUsername = mysqli_real_escape_string($conn,$_POST['usernameAdmin']);
  $newpass = mysqli_real_escape_string($conn,$_POST['confpassAdmin']);


  if($size <= 0){
    $sql = "UPDATE `admin` SET `Surname`='$sName',`Firstname`='$fName',`MI`='$mName',`email`='$email',
    `Username`='$newUsername',`Password`='$newpass' where AdminID = ".$_SESSION['ID'].";";

    $insert = mysqli_query($conn, $sql);

    if($insert === true){
        $sql = "SELECT AdminID, Password,  CONCAT(UPPER(Surname),', ',FirstName ) as Name FROM `admin` WHERE AdminID = ".$_SESSION['ID'].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $row['Name']; 
            echo '
            <script>

            $(document).ready(function(){
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
            });
            </script>
            ';           
    }
    else{
            die($conn);
    }
  }
  else{
    if($size > 250000){
      echo '
      <script>

      $(document).ready(function(){
          Swal.fire({
              title: "File Exceeds Limit",
              icon: "error",
              showConfirmButton: false,
              timer: 1000,
            })
            .then(function(){
              window.location.href = "Settings.php" 
            })
      });
      </script>
      '; 
    }
    else{
      $img = pathinfo($image, PATHINFO_EXTENSION);
      $lc = strtolower($img);
      $allowedType = array("jpeg", "jpg", "png");
      
      if(in_array($lc,$allowedType)){
        $newName = uniqid('img',true).'.'.$lc;
        $path = '../pictures/'. $newName;
        move_uploaded_file($tempName, $path);

        $sql = "UPDATE `admin` SET `Surname`='$sName',`Firstname`='$fName',`MI`='$mName',`profile`='$newName',`email`='$email',
        `Username`='$newUsername',`Password`='$newpass' where AdminID = ".$_SESSION['ID'].";";
    
        $insert = mysqli_query($conn, $sql);

    if($insert === true){
        $sql = "SELECT AdminID, Password, profile,  CONCAT(UPPER(Surname),', ',FirstName ) as Name FROM `admin` WHERE AdminID = ".$_SESSION['ID'].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $row['Name']; 
        $_SESSION['profile'] = $row['profile']; 
            echo '
            <script>

            $(document).ready(function(){
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
            });
            </script>
            ';           
    }
    else{
            die($conn);
    }
      }
      else{
        echo '
        <script>

        $(document).ready(function(){
            Swal.fire({
                title: "Invalid File Type!",
                icon: "error",
                showConfirmButton: false,
                timer: 1000,
              })
              .then(function(){
                window.location.href = "Settings.php" 
              })
        });
        </script>
        '; 
      }

    }
  }
        
  
}





?>
