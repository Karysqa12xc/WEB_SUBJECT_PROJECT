<?php
require "conn.php";
session_start();
$userLogIn = $_POST['userLogIn'];
$passwordLogIn = $_POST['passLogIn'];
$_SESSION['user'] = $userLogIn;
$sql = "SELECT * FROM `users` WHERE username = '$userLogIn' AND password = '$passwordLogIn'";
$result = $conn->query($sql);
if($result->num_rows == 1){
    header('location:trangchu.php');
}
else{
    echo "Tài khoản bạn nhập không tồn tại";
}
?>