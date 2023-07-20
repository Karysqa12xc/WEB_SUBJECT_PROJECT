<?php
    $locallhost = "localhost";
    $userName  = "root";
    $password = "";
    $database = "btl_web_a1";
    $conn = new mysqli($locallhost, $userName, $password, $database);
    mysqli_set_charset($conn, 'UTF8');
?>