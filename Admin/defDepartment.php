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
$q = "SELECT* FROM department
 WHERE ElectionId =".$_SESSION['eID']." AND status = 'active';";
$r =mysqli_query($conn,$q);
if(mysqli_num_rows($r) > 0 ){
    ?>
            <table id="body" cellspacing="0">
            <tbody>
    <?php
            while($rs = $r->fetch_assoc()){ 
                 ?>
                <tr>
                    <td class="dIdt"><?php echo $rs['ID']?></td>
                    <td class="dNamet"><?php echo $rs['DepartmentName']?></td>
                    <td class="deditC">
                        <Button class="editBtn" type="button" name="editDepartmen" value="<?php echo $rs['ID']?>">
                        <i class="fa-solid fa-pen"></i></Button>
                        <Button class="deleteBtn" type="button" name="deleteDepartment" value="<?php echo $rs['ID']?>">
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
            <td class="dNamet">No Department found!</td>
            <td class="dIdt"></td>
        </tr>  
    </tbody>
</table>
<?php
}
?>

