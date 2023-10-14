<?php
    session_start();
    require("./conn/connection.php");
 
        session_unset();
        session_destroy(); 
        echo '<script> window.location.href = "./index.php" </script> ';
    mysqli_close($conn);
?>