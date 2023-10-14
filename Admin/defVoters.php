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
$q = "SELECT VoterID, DepartmentID, CONCAT(UPPER(lName),', ',fName,' ', mName ) as Name FROM voter
 WHERE ElectionId =".$_SESSION['eID']." AND status = 'active';";
$r =mysqli_query($conn,$q);
if(mysqli_num_rows($r) > 0 ){
    ?>
            <table id="body" cellspacing="0">
            <tbody>
    <?php
            while($rs = $r->fetch_assoc()){ 
                $q1 = "SELECT DepartmentName FROM department where ID =".$rs['DepartmentID'].";";
                $r1 =mysqli_query($conn,$q1);
                $rs1 = mysqli_fetch_assoc($r1);
                 ?>
                <tr>
                    <td class="vIdt"><?php echo $rs['VoterID']?></td>
                    <td class="vNamet"><?php echo $rs['Name']?></td>
                    <td class="vDept"><?php echo $rs1['DepartmentName']?></td>
                    <td class="editC">
                        <Button class="editBtn" type="button" name="updVoter" value="<?php echo $rs['VoterID']?>">
                        <i class="fa-solid fa-pen"></i></Button>
                        <Button class="deleteBtn" type="button" name="dlVoter" value="<?php echo $rs['VoterID']?>">
                        <i class="fa-solid fa-trash"></i></Button>
                    </td>
                </tr>
                <?php
}}
else{

?>
<table id="body" cellspacing="0">
    <tbody>
        <tr>
            <td class="vIdt"></td>
            <td class="vNamet">No active voters found!</td>
            <td class="vDept"></td>
        </tr>  
    </tbody>
</table>
<?php
}
?>

