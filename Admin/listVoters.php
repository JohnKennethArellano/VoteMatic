<?php
    session_start();
    require("../conn/connection.php");
    if(!isset($_SESSION['ID']) && !isset($_SESSION['admin'])){      
       echo'<script> window.location.href = "../index.php" ;</script>';
       mysqli_close($conn);
       exit();
    }

$output = '';
if(isset($_POST['id']))
{
    $query = "SELECT VoterID, DepartmentID, CONCAT(UPPER(lName),', ',fName,' ', mName ) 
    as Name FROM voter where ElectionID =".$_POST['id'].";";
    $result =$conn->query($query);
?>

    <table id="body" cellspacing="0">
        <tbody>

<?php   
    if($result->num_rows > 0 ){
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
                <Button class="editBtn"><i class="fa-solid fa-pen"></i></Button>
                <Button class="deleteBtn" name="dlVoter" value="<?php echo $res['VoterID']?>">
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

        <tr>
            <td class="vIdt"></td>
            <td class="vNamet">No Voters for this Election!</td>
            <td class="vDept"></td>
        </tr> 
        </tbody>
    </table>

<?php   

        }
}
else{
}

?>
