<?php
require 'conn.php';
$friendID = $_POST['userNameOfFriend'];
session_start();
$userNameLogged = $_SESSION['user'];
$sqlReadAllTableUser = "SELECT * FROM `users` WHERE username = '$userNameLogged'";
$resultReadAllTableUser = $conn->query($sqlReadAllTableUser);
if($resultReadAllTableUser->num_rows > 0){
    $rowReadAllTableUser = $resultReadAllTableUser->fetch_assoc();
    $userID = $rowReadAllTableUser['user_id'];
}
$sqlReadExcept1ColTableUser = "SELECT * FROM `users` WHERE username != '$userNameLogged'";
$resultReadExcept1ColTableUser = $conn->query($sqlReadExcept1ColTableUser);
if($resultReadExcept1ColTableUser->num_rows>0){
    while($rowReadExcept1ColTableUser = $resultReadExcept1ColTableUser->fetch_assoc()){
        if($friendID == $rowReadExcept1ColTableUser['user_id']){
            $sqlInsertTableFriend = "INSERT INTO `friends`(`user_id`, `friend_id`, `status`) VALUES ('$userID','$friendID','Chưa đồng ý')";
            if($conn->query($sqlInsertTableFriend)){
                header('location:trangChu.php');
            }
        }
    }
}
$conn->close();
?>