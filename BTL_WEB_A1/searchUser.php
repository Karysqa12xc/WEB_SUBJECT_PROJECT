<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý user</title>
    <style>
        body{
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
        }
        table{
            width: 100%;
        }
        h1{
            font-size: 25px;
        }
        select{
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
            ;
        }
        td{
            color: brown;
            font-weight: 800;
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
    <h1>Tìm kiếm thông tin của các User!!!</h1>
    <form action="" method="post">
        <label for="timKiem">Chọn Tên Của user: </label>
        <select name="timKiem" id="">
            <?php
            require 'connectDB.php';
            session_start();
            if(!isset($_SESSION['user'])){
                header('location:logIn.php');
            }else{
                $sql = "SELECT * FROM `userfitness` WHERE tenNguoiDung != 'admin' AND tenNguoiDung != '' AND chuc_vu != 1";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        $tenUser = $row['tenNguoiDung'];
                        if($tenUser == $_POST['timKiem'] && isset($_POST['timKiem'])){
                            echo "<option value = '$tenUser' selected>$tenUser</option>";   
                        }else{
                            echo "<option value = '$tenUser'>$tenUser</option>";   
                        }
                        
                    }
                } 
            }
            ?>
        </select>
        <input type="submit" name="guiGiaTri" value="Tìm kiếm">
        <input type="submit" name="timToanBo" value="Tìm toàn bộ">
    </form>
    <?php
    if (isset($_POST['timToanBo'])) {
        $sql_searchAll = "SELECT * FROM `userfitness` WHERE tenNguoiDung != 'admin' AND tenNguoiDung != '' AND chuc_vu != 1";
        $result_timKiemToanBo = $conn->query($sql_searchAll);
        echo " <table border='1'>
        <caption><b>Thông tin của người dùng</b></caption>
        <tr>
            <th>Tên người dùng</th>
            <th>password</th>
            <th>email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Gói đăng ký</th>
            <th>Chức vụ</th>
            <th>Ngày đăng ký</th>
        </tr>";
        if ($result_timKiemToanBo->num_rows > 0) {
            while ($row_timKiemToanBo = $result_timKiemToanBo->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row_timKiemToanBo['tenNguoiDung'] . "</td>
                    <td>" . $row_timKiemToanBo['password'] . "</td>
                    <td>" . $row_timKiemToanBo['email'] . "</td>
                    <td>" . $row_timKiemToanBo['soDienThoai'] . "</td>
                    <td>" . $row_timKiemToanBo['address'] . "</td>
                    <td>" . $row_timKiemToanBo['goi_dang_ky'] . "</td>
                    <td>" . $row_timKiemToanBo['chuc_vu'] ."-user</td>
                    <td>" . $row_timKiemToanBo['ngay_dang_ky'] . "</th>
                </tr>";
            }
            echo "</table>";
            $conn->close();
            die();
        }
    }
    if(isset($_POST['guiGiaTri'])){
        $giaTriTimKiem = $_POST['timKiem'];
        $sql_search = "SELECT * FROM `userfitness` WHERE tenNguoiDung = '$giaTriTimKiem'";
        $result_timKiem = $conn->query($sql_search);
        $row_timKiem = $result_timKiem->fetch_assoc();
        echo "  <table border='1'>
        <caption><b>Thông tin của người dùng</b></caption>
        <tr>
            <th>Tên người dùng</th>
            <th>password</th>
            <th>email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Gói đăng ký</th>
            <th>Chức vụ</th>
            <th>Ngày đăng ký</th>
        </tr>
        <tr>
            <th>".$row_timKiem['tenNguoiDung']."</th>
            <th>".$row_timKiem['password']."</th>
            <th>".$row_timKiem['email']."</th>
            <th>".$row_timKiem['soDienThoai']."</th>
            <th>".$row_timKiem['address']."</th>
            <th>".$row_timKiem['goi_dang_ky']."</th>
            <th>".$row_timKiem['chuc_vu']."</th>
            <th>".$row_timKiem['ngay_dang_ky']."</th>
        </tr>
    </table>";
        $conn->close();
        die();
    }
    ?>
  
</body>

</html>