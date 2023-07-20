<?php
$userName = 'localhost';
$root = 'root';
$password = '';
$database = 'btl_web_a2';
$conn =new mysqli($userName, $root, $password, $database);
mysqli_set_charset($conn, 'UTF8');
?>