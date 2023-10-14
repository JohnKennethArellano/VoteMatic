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
$q = "SELECT CandidateID, profile, PositionID, partylist, Platform, CONCAT(UPPER(lName),', ',fName,' ', mName ) as Name FROM candidate
 WHERE ElectionId =".$_SESSION['eID']." AND status = 'active';";
$r =mysqli_query($conn,$q);
if(mysqli_num_rows($r) > 0 ){
    ?>
            <table id="body" cellspacing="0">
            <tbody>
    <?php
            while($rs = $r->fetch_assoc()){ 
                $q1 = "SELECT Description FROM position where positionID =".$rs['PositionID'].";";
                $r1 =mysqli_query($conn,$q1);
                $rs1 = mysqli_fetch_assoc($r1);

                $q2 = "SELECT partylistname FROM partylist where ID =".$rs['partylist'].";";
                $r2 =mysqli_query($conn,$q2);
                $rs2 = mysqli_fetch_assoc($r2);
                 ?>
                <tr>
                    <td class="cIdt"><?php echo $rs['CandidateID']?></td>
                    <td class="pict"><img src="../pictures/<?php echo $rs['profile']?>" alt=""></td>
                    <td class="cNamet"><?php echo $rs['Name']?></td>
                    <td class="cPlatformt"><?php echo $rs['Platform']?></td>
                    <td class="cPost"><?php echo $rs1['Description']?></td>
                    <td class="cPart"><?php echo $rs2['partylistname']?></td>
                    <td class="editT">
                        <Button class="editBtn" type="button" name="updCandidate" value="<?php echo $rs['CandidateID']?>">
                        <i class="fa-solid fa-pen"></i></Button>
                        <Button class="deleteBtn" type="button" name="dlCandidate" value="<?php echo $rs['CandidateID']?>">
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
                    <td class="cIdt"></td>
                    <td class="pict"></td>
                    <td class="cNamet"></td>
                    <td class="cPlatformt">No Candidate Found!</td>
                    <td class="cPost"></td>
                    <td class="cPart"></td>
                    <td class="editT">
                    </td>
                    </tr>  
                </tbody>
            </table>
<?php
}
?>

