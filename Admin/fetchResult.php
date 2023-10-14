<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }
    
?>

<?php
        $sql = "SELECT * FROM position where ElectionID =".$_SESSION['eID']." and status != 'deleted' ORDER BY Priority ASC;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $pos = str_replace(' ','',$row['Description']);
            echo '<div class="positionContainer">
            <div class="posTitle">'.$row['Description'].'</div>
           <div class="boxBody">
           <canvas id = '.$pos.'></canvas>
           </div>
            </div>';
        }        
?>

<?php
  $sql1 = "SELECT * FROM position where ElectionID =".$_SESSION['eID']." and status != 'deleted' ORDER BY Priority ASC;";
  $query = mysqli_query($conn, $sql1);
  while($row = mysqli_fetch_assoc($query)){
    $pos = str_replace(' ','',$row['Description']);
    $sql2 = "SELECT * FROM candidate WHERE PositionID = '".$row['positionID']."' and status != 'deleted'";
    $cquery = mysqli_query($conn, $sql2);
    $carray = array();
    $varray = array();
    while($crow = mysqli_fetch_assoc($cquery)){
      array_push($carray, $crow['lName']);
      $sql3 = "SELECT * FROM voted WHERE CandidateID = '".$crow['CandidateID']."' and ElectionID = ".$_SESSION['eID'].";";
      $vquery = mysqli_query($conn, $sql3);
      array_push($varray, mysqli_num_rows($vquery));
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
?>
    <script>
        $(document).ready(function(){
      var rowid = '<?php echo $row['positionID']; ?>';
      var description = '<?php echo $pos;  ?>';
      var barChartCanvas = $('#' + description).get(0).getContext('2d')

    let massPop = new Chart(barChartCanvas , {
    type: 'bar',
    data:{
      labels: <?php echo $carray; ?>,
      datasets:[{
        label: 'Votes',
        data:  <?php echo $varray; ?>
        
      }]
    },
    options:{ 
        animation:{
            duration: 0
        },
    responsive: true,
    scales:{
    y:{
        beginAtZero: true,
        grid: {
            display: false
        },
    },
    x: {
         grid:{
            display: false
         }
    }

    },
    plugins:{
        legend: {
            display:false 
            
        }
    }
    }
  }) 

});
    </script>

<?php
    }
    ?>