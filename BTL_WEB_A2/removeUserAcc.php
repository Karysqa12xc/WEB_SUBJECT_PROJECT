<?php
require 'conn.php';
session_start();
$userNameLogged = $_SESSION['user'];
$sqlReadAllTableUser = "SELECT * FROM `users` WHERE username = '$userNameLogged'";
$resultReadAllTableUser = $conn->query($sqlReadAllTableUser);
if($resultReadAllTableUser->num_rows > 0){
    $rowReadAllTableUser = $resultReadAllTableUser->fetch_assoc();
    $userID = $rowReadAllTableUser['user_id'];
}
$sqlDelUserAtTableDFriends = "DELETE FROM friends WHERE user_id =  $userID OR friend_id =  $userID;";
$sqlDelUserAtTablePosts = "DELETE FROM posts WHERE user_id = $userID;";
$sqlDelUser = "DELETE FROM users WHERE user_id = $userID;";
if ($conn->query($sqlDelUserAtTableDFriends) && $conn->query($sqlDelUserAtTablePosts) && $conn->query($sqlDelUser))
    header("location:logOut.php");
else
    echo 'Không xóa thành công';

?>