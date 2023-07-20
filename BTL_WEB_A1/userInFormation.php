<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân của người dùng</title>
    <style>
    body {
        position: relative;
        font-size: 20px;
        font-family: 'Courier New', Courier, monospace;
        background-image: url();
    }

    a {
        font-family: 'Courier New', Courier, monospace;
    }

    .table__information {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, 50%);
        width: 100%;
        border: 1px solid #fff;
        background-color: black;
    }

    caption {
        padding-bottom: 10px;
    }

    .row__header {
        text-align: center;
        padding: 15px;
        color: #fff;
        border: 0.4px solid #fff;
        line-height: 15px;
    }

    .row__content {
        padding: 10px;
        color: #fff;
        text-align: center;
        border: 0.4px solid #fff;
        border-collapse: collapse;
    }

    .update__information {
        text-decoration: none;
        color: red;
        font-size: 20px;
    }

    caption {
        font-size: 50px;
        color: #fa6166;
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
    </style>
</head>

<body>
    <a class="back" href="TrangChu.php"><-back</a>
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
            <?php
    require 'connectDB.php';
    mysqli_set_charset($conn, 'UTF8');
    session_start();
    if(isset($_SESSION['user'])){
        $sql = "SELECT * FROM `userfitness` WHERE tenNguoiDung = '". $_SESSION['user'] . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['password'] = $row['password'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phoneNumber'] = $row['soDienThoai'];
        $_SESSION['address'] = $row['address'];
        echo "<table class='table__information'>";
        echo "     <caption><b>Thông tin của người dùng</b></caption>
        <tr>
            <th class='row__header'>Tên người dùng</th>
            <th class='row__header'>Mật khẩu</th>
            <th class='row__header'>Email</th>
            <th class='row__header'>Số điện thoại</th>
            <th class='row__header'>Địa chỉ</th>
            <th class='row__header'>Gói tập đang đăng ký</th>
        </tr>".
        "<tr>
            <td rowspan ='2' class='row__content'>" .$row['tenNguoiDung'] ."</td>
            <form action ='updateInfoUser.php' method = 'POST'>
                <td class='row__content'>". $row['password'] . "
                    <button name = 'updatePassBtn'><a class = 'update__information'>
                        Sửa thông tin
                    </a></button>
                </td>
                <td class='row__content'>". $row['email'] . "
                    <button name = 'updateMailBtn'><a class = 'update__information'>
                        Sửa thông tin
                    </a></button>
                </td>
                <td  class='row__content'>". $row['soDienThoai'] . "
                     <button name = 'updatePhoneNumberBtn'><a class = 'update__information'>
                        Sửa thông tin
                    </a></button>
                </td>
                <td class='row__content'>". $row['address'] . "
                     <button name = 'updateAddressBtn'><a class = 'update__information'>
                        Sửa thông tin
                    </a></button>
                 </td>
                 <td class='row__content'>". $row['goi_dang_ky'] . "</td>
        </tr>
            </form>";
        echo "</table>";
        $conn->close();
    }else{
        header('location:logIn.php');
    }
 
    ?>
</body>

</html>