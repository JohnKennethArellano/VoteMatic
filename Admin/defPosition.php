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
$q = "SELECT * FROM position
 WHERE ElectionId =".$_SESSION['eID']." AND status = 'active' ORDER by Priority ASC;";
$r =mysqli_query($conn,$q);
if(mysqli_num_rows($r) > 0 ){
    ?>
            <table id="body" cellspacing="0">
            <tbody>
    <?php
            while($rs = $r->fetch_assoc()){ 
                 ?>
                <tr>
                    <td class="posIdt"><?php echo $rs['positionID']?></td>
                    <td class="posNamet"><?php echo $rs['Description']?></td>
                    <td class="posMax"><?php echo $rs['Max_Vote']?></td>
                    <td class="posWin"><?php echo $rs['WinnersCount']?></td>
                    <td class="posPrio"><?php echo $rs['Priority']?></td>
                    <td class="poseditC">
                        <Button class="editBtn" type="button" name="editPartylist" value="<?php echo $rs['positionID']?>">
                        <i class="fa-solid fa-pen"></i></Button>
                        <Button class="deleteBtn" type="button" name="deletePartylist" value="<?php echo $rs['positionID']?>">
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
            <td class="dIdt"></td>
            <td class="dNamet">No Position found!</td>
            <td class="dIdt"></td>
        </tr>  
    </tbody>
</table>
<?php
}
?>

