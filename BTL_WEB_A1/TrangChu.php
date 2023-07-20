<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fitness World</title>
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

    .bg_main {
        width: 100%;
        height: 100%;
    }

    img {
        width: 100%;
        height: 625px;
        border-radius: 20px;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:logIn.php');
    }else{
        echo "<div class='navbar'>";
        echo "<h1 class = 'header__title'>Chào mừng " . $_SESSION['user'] .  " đến với fitness hoàng gia "  . "</h1>";
        echo "<button class = 'logOut__btn'>
                <a href='logOut.php' class= 'logOut__link'>Đăng xuất</a>
            </button>";
        echo "</div>";
    }
    if(isset($_SESSION['user']) and $_SESSION['user'] == 'admin'){
        echo "
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
    </div>";
        echo "<div class='bg_main'>
        <img src='img/Ảnh nền.jpg'>
        </div>";
        die();
    }
    if(isset($_SESSION['user'])){
        echo "
        <div class='menu__bar'>
        <ul class='content__list'>
            <li class='content__item'>
                <a href='userInFormation.php' class='content__link'>
                    Thông tin cá nhân
                </a>
            </li>
            <li class='content__item'>
                <a href='dangKyGoiTap.php' class=;content__link'>
                    Đăng ký gói tập
                </a>
            </li>
            <li class='content__item'>
                <a href='deleteUser.php' class='content__link'>
                    Tự hủy
                </a>
            </li>
        </ul>
    </div>
    <div class='bg_main'>
        <img src='img/Ảnh nền.jpg'>
    </div>";
    die();
    }
    ?>


</body>

</html>