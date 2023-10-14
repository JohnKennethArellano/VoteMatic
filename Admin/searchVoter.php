<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }


if(isset($_POST['search'])){

    $query = "SELECT VoterID, DepartmentID, status, CONCAT(UPPER(lName),', ',fName,' ', mName ) as Name FROM voter 
    where  (lName LIKE "."'%".$_POST['search']."%'"." OR fName LIKE "."'%".$_POST['search']."%'"." 
    OR mName LIKE "."'%".$_POST['search']."%'"." OR VoterID LIKE "."'%".$_POST['search']."%'". 
    "OR VoterID LIKE "."'%".$_POST['search']."%') AND (ElectionId = ".$_SESSION['eID']." and status = 'active');";
    $result =$conn->query($query);

    if($result->num_rows > 0 ){
        ?>
                <table id="body" cellspacing="0">
                <tbody>
        <?php
        while($res = $result->fetch_assoc()){
            $query1 = "SELECT DepartmentName FROM department where ID =".$res['DepartmentID'].";";
            $result1 =$conn->query($query1);
            $res1 = $result1->fetch_assoc();
            ?>
         <tr>
            <td class="vIdt"><?php echo $res['VoterID']?></td>
            <td class="vNamet"><?php echo $res['Name']?></td>
            <td class="vDept"><?php echo $res1['DepartmentName']?></td>
            <td class="editC">
                <Button class="editBtn" name="updVoter" value="<?php echo $rs['VoterID']?>">
                    <i class="fa-solid fa-pen"></i></Button>
                <Button class="deleteBtn"  name="dlVoter" value="<?php echo $rs['VoterID']?>">
                    <i class="fa-solid fa-trash"></i></Button>
            </td>
        </tr>  
        <?php
        }
        ?>
            </tbody>
            </table>
        <?php
    }
    else{
        ?>
            <table id="body" cellspacing="0">
                <tbody>
                    <tr>
                        <td class="vIdt"></td>
                        <td class="vNamet">No Voters found!</td>
                        <td class="vDept"></td>
                    </tr>  
                </tbody>
            </table>
      <?php
    }


}


?>