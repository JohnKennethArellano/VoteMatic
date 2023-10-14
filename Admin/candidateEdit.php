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


if(isset($_POST['editCandidate'])){

  $image = $_FILES['photo']['name'];
  $size = $_FILES['photo']['size'];
  $tempName = $_FILES['photo']['tmp_name'];

  $sName = mysqli_real_escape_string($conn,$_POST['csName']);
  $sName  = ucfirst($sName);
  $fName = mysqli_real_escape_string($conn,$_POST['cfName']);
  $fName  =ucfirst($fName);
  $mName = mysqli_real_escape_string($conn,$_POST['cmName']);
  $mName = strtoupper($mName);
  $platform = mysqli_real_escape_string($conn,$_POST['platform']);
  $position = $_POST['posAve'];
  $partylist = $_POST['parAve'];

  date_default_timezone_set('Asia/Manila');
  $date = date('Y-m-d H:i:s');
  $date = strtotime($date);
  
  $fndlctn = "SELECT * FROM election where ElectionID = ".$_SESSION['eID']." and status = 'active';";
  $res = mysqli_query($conn,$fndlctn);
  
  if(mysqli_num_rows($res) > 0){
      $r = mysqli_fetch_assoc($res);
      $start = strtotime($r['Start']);
      
  
      $diff = $start - $date;
  
      if($diff < 0){
          echo '<script>
          $(document).ready(function(){
              Swal.fire({
                  icon: "warning",
                  title: "Election Ongoing",
                  text: "Cannot Edit Details",
                  showConfirmButton: false,
                  timer: 1000,                 
                })
                .then(function(){
                  window.location.href = "Candidates.php" 
                })
          })       
          </script>';
      }
      else{
        if($size <= 0){
          $sql = "UPDATE `candidate` SET `lName`='$sName',`fName`='$fName',`mName`='$mName',`PositionID`='$position',
          `partylist`='$partylist',`Platform`='$platform' where CandidateID = ".$_SESSION['canID'].";";
      
          $insert = mysqli_query($conn, $sql);
      
          if($insert === true){
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
                          window.location.href = "Candidates.php" 
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
                    window.location.href = "Candidates.php" 
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
      
            $sql = "UPDATE `candidate` SET `lName`='$sName',`fName`='$fName',`mName`='$mName',`profile`='$newName',`PositionID`='$position',
          `partylist`='$partylist',`Platform`='$platform' where CandidateID = ".$_SESSION['canID'].";";
      
          $insert = mysqli_query($conn, $sql);
      
          if($insert === true){
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
                          window.location.href = "Candidates.php" 
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
                      window.location.href = "Candidates.php" 
                    })
              });
              </script>
              '; 
            }
      
          }
        }
    
      }
  
  }
  



 
        
  
}





?>
