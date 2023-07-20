<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý coach</title>
    <style>
    body {
        font-size: 20px;
        font-family: 'Courier New', Courier, monospace;
    }

    table {
        width: 100%;
        text-align: center;
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
    <form action="" method="POST">
        <table border="1">
            <caption><b>Quản lý Coach và Gói tập!!!</b></caption>
            <tr>
                <th>Tên Coach</th>
                <th>password</th>
                <th>email</th>
                <th>Số điện thoại</th>
                <th>Gói tập được phân công quản lý</th>
            </tr>
            <?php
        require "connectDB.php";
        session_start();
        if(!isset($_SESSION['user'])){
            header("location:logIn.php");
            } else {
                $sql = "SELECT userfitness.tenNguoiDung, userfitness.password, userfitness.email, userfitness.soDienThoai ,trailing_schedule.goi_tap FROM `trailing_schedule` ,`userfitness` WHERE userfitness.tenNguoiDung = trailing_schedule.Coach AND userfitness.tenNguoiDung != ''";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo " <tr>
                    <td>" . $row['tenNguoiDung'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['soDienThoai'] . "</td>
                    <td>" . $row['goi_tap'] . "</td>
                </tr>";
                    }
                }

            }
        ?>
        </table>
    </form>

</body>

</html>