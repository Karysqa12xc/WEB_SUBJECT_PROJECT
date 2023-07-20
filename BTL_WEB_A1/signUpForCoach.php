<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo tài khoản cho Coach</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
    }
    
    .navbar {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .logOut__link {
        text-decoration: none;
        color: black;
    }

    .logOut__btn {
        height: 36px;
    }

    .header__title {
        color: #fa6166;

    }

    .menu__bar {
        margin-top: -20px;
        padding-top: 10px;
    }

    .content__list {
        list-style: none;
        display: flex;
        padding-left: 0;
    }

    .content__item {
        padding-left: 15px;
        position: relative;
    }
    </style>
</head>

<body>
<a href="TrangChu.php"><-back</a>
<div class='menu__bar'>
        <ul class='content__list'>
            <li class='content__item'>
                <a href='searchUser.php' class='content__link'>
                    Quản lý user
                </a>
            </li>
            <li class='content__item'>
                <a href='chucVu.php' class='content__link'>
                    Thêm chức vụ
                </a>
            </li>
            <li class='content__item'>
                <a href='signUpForCoach.php' class='content__link'>
                   Tạo tài khoản cho Coach
                </a>
            </li>
            <li class='content__item'>
                <a href='updateCoachForPackage.php' class='content__link'>
                    Phân công coach cho các gói tập
                </a>
            </li>
            <li class='content__item'>
            <a href='Coach.php' class='content__link'>
               Quản lý Coach
            </a>
        </li>
        <li class='content__item'>
        <a href='updatePackage.php' class='content__link'>
            Sửa đổi gói tập
        </a>
    </li>
        </ul>
    </div>
   
            <h1>Tạo tài khoản cho coach!!!</h1>
            <form action="" method="POST">
                <label for="userName">Tên tài khoản: </label>
                <input type="text" name="userName" id="" placeholder="Nhập tên của bạn"><br>
                <label for="pass">Mật khẩu: </label>
                <input type="password" name="pass" id="" placeholder="Nhập mật khẩu của bạn"><br>
                <label for="re_password">Nhập lại mật khẩu: </label>
                <input type="password" name="re_password" id="" placeholder="Nhập lại mật khẩu của bạn"><br>
                <label for="E_mail">Email: </label>
                <input type="email" name="E_mail" id="" placeholder="xx...xx@gmail.com"><br>
                <label for="phoneNumber">Số điện thoại: </label>
                <input type="tel" name="phoneNumber" placeholder="0xxx-xxx-xxx" id=""
                    pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}"><br>
                <input type="submit" name="tao" value="Tạo">
            </form>

            <?php
    require 'connectDB.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:logIn.php');
    }else{
    if(isset($_POST['tao'])){
        $userName = $_POST['userName'];
        $passWord = $_POST['pass'];
        $re_pass = $_POST['re_password'];
        $Email = $_POST['E_mail'];
        $phone_number = $_POST['phoneNumber'];
        if($passWord == $re_pass){
            $sql =  "INSERT INTO `userfitness`(`tenNguoiDung`, `password`, `email`, `soDienThoai`, `chuc_vu`) 
            VALUES ('$userName','$passWord','$Email','$phone_number', '1')";
            if($conn->query($sql)){
                echo "Tạo thành công";
            }
            $conn->close();
        }else{
            echo "Mật khẩu bạn nhập lại không trùng khớp";
        }
    }
    }
    ?>
</body>

</html>