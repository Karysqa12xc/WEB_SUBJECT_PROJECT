<?php
session_start();
$infoUserDif = $_POST['searchData'];
$_SESSION['userDif'] = $infoUserDif;
if(isset($_SESSION['userDif'])){
    header("location:readUserDif.php");
}
?>