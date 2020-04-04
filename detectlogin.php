<?php

if(isset($_SESSION['userId'])){
    if ($_SESSION['userType'] == "C") {
        echo "<p align=right>".$_SESSION['userFName']." ".$_SESSION['userSName']." / Customer No.".$_SESSION['userId']."</p>";
    } else {
        echo "<p align=right>".$_SESSION['userFName']." ".$_SESSION['userSName']." / Administrator No.".$_SESSION['userId']."</p>";
    }
}

?>
