<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin user</title>
    <style>
    body {
        position: relative;
        font-size: 20px;
        font-family: 'Courier New', Courier, monospace;
    }

    input {
        font-family: 'Courier New', Courier, monospace;
    }
    </style>
</head>

<body>
    <a href="userInformation.php">
        <-back</a>
            <?php
    require 'connectDB.php';
    mysqli_set_charset($conn, 'UTF8');
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:logIn.php');
    }else{
        $userName = $_SESSION['user'];
        $email = $_SESSION['email'];
        $phoneNumber = $_SESSION['phoneNumber'];
        $address = $_SESSION['address'];
        if (isset($_POST['updatePassBtn'])) {
            echo "<form method='POST'>
                <label for = 'upPass'>Nhập mật khẩu mà mới của bạn:</label>
                <input type='password' name='upPass'><br>
                <label for = 'upPass'>Nhập lại mật khẩu mới của bạn:</label>
                <input type='password' name='re_upPass'><br>
                <input type='submit' value='Update' name='suaPass'>
                </form>";
            die();
        }
        if(isset($_POST['suaPass'])){
            $upPass = $_POST['upPass'];
            $re_upPass = $_POST['re_upPass'];
            if($upPass == $re_upPass){
                $sql = "UPDATE `userfitness` SET `password`='$upPass' WHERE `tenNguoiDung`='$userName'";
                if($conn->query($sql)){
                    echo '<h1>Bạn đã sửa thành công</h1>';
                }
            }else{
                echo 'Mật khẩu nhập lại không trùng khớp';
            }
            die();
        }
        if(isset($_POST['updateMailBtn'])){
            echo "<form action='' method ='POST'>
            <label for = 'upEmail'>Nhập email bạn muốn sửa:</label>   
            <input type='email' name = 'upEmail' value = '$email' placeholder='xx...xx@gmail.com'>
            <input type='submit' value='Update' name='suaEmail'>   
            </form>";
            die();
        }
        if(isset($_POST['suaEmail'])){
            $Update = $_POST['upEmail'];
            $sql = "UPDATE `userfitness` SET `email`='$Update' WHERE `tenNguoiDung`='$userName'";
            if($conn->query($sql)){
                echo '<h1>Bạn đã sửa thành công</h1>';
            }
            die();
        }
            
        if(isset($_POST['updatePhoneNumberBtn'])){
            echo "<form action='' method ='POST'>
            <label for='upPhoneNumber'>Cập nhật số điện thoại: </label>
            <input type='tel' name='upPhoneNumber' placeholder='0xxx-xxx-xxx' value = '$phoneNumber' pattern='[0-9]{4}-[0-9]{3}-[0-9]{3}'><br>
            <input type='submit' value='Update' name='suaPhone'>   
            </form>";
        }
        if(isset($_POST['suaPhone'])){
            $Update = $_POST['upPhoneNumber'];
            $sql = "UPDATE `userfitness` SET `soDienThoai`='$Update' WHERE `tenNguoiDung`='$userName'";
            if($conn->query($sql)){
                echo '<h1>Bạn đã sửa thành công</h1>';
            }
            die();
        }
        if(isset($_POST['updateAddressBtn'])){
            echo "<form action='' method ='POST'>
            <label for ='upAddress'>Cập nhật địa chỉ: </label>
            <input type='text' name = 'upAddress' value = '$address'>
            <input type='submit' value='Update' name='suaAddress'>   
            </form>";
        }
        if(isset($_POST['suaAddress'])){
            $Update = $_POST['upAddress'];
            $sql = "UPDATE `userfitness` SET `address`='$Update' WHERE `tenNguoiDung`='$userName'";
            if($conn->query($sql)){
                echo '<h1>Bạn đã sửa thành công</h1>';
            }
            die();
        }
        $conn -> close();
    }
    ?>
</body>

</html>