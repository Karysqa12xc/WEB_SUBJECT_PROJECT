<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa người dùng</title>
</head>
    <style>
        body{
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
<body>
    <?php
require 'connectDB.php';
session_start();
if(!isset($_SESSION['user'])){
    header('location:logIn.php');
}else{
    $tenNguoiDung = $_SESSION['user'];
    $sql = "DELETE FROM `userfitness` WHERE tenNguoiDung = '$tenNguoiDung'";
    if($conn->query($sql)){
        echo "<h1>Bạn đã xóa tài khoản của bạn!</h1>";
    }else{
        echo "Có lỗi gì đó khiến câu lệnh không thực hiện";
    }
}
?>
    <br><a href="logIn.php">Về lại trang đăng nhập</a>
</body>

</html>