<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký gói tập</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .title_header {
        margin: auto;
        color: #fa6166;
        padding: 25px;
    }

    input {
        font-family: 'Courier New', Courier, monospace;
    }

    tr {
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
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:logIn.php');
    }else{
        echo "<div class = 'container'>";
        echo "<h1 class = 'title_header'>Các gói tập của chúng tôi</h1>";
        $sql = "SELECT * FROM `trailing_schedule` WHERE trailing_schedule.goi_tap != 'Chưa đăng ký'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            echo "<form method = 'POST'>";
            echo "<table border='1'>";
            echo " <tr>
            <td>Các gói tập</td>
            <td>Thứ hai</td>
            <td>Thứ ba</td>
            <td>Thứ tư</td>
            <td>Thứ năm</td>
            <td>Thứ sáu</td>
            <td>Thứ bảy</td>
            <td>Chủ nhật</td>
            <td>Giá</td>
            <td>Coach phụ trách</td>
            <td>Đăng ký</td>
        </tr>";
            while($row = $result->fetch_assoc()){
            echo "<tr>
                <th>".$row['goi_tap'] ."</th>
                <th>".$row['thu_hai']."</th>
                <th>".$row['thu_ba']."</th>
                <th>".$row['thu_tu']."</th>
                <th>".$row['thu_nam']."</th>
                <th>".$row['thu_sau']."</th>
                <th>".$row['thu_bay']."</th>
                <th>".$row['chu_nhat']."</th>
                <th>".$row['Gia']."</th>
                <th>".$row['Coach']."</th>
                <th><input type='checkbox' name = 'goidangky[]' value = '". $row['goi_tap'] ."'></th>
            </tr>";
            }
            echo "<input type='submit' name='dangky' value= 'Đăng ký gói tập'>";
            echo "</form>";
            echo "</table>";
        }
        echo "</div>";
        if(isset($_POST['dangky'])){
            $dangKy = $_POST['goidangky'];
            if(isset($dangKy)){
                $demSoCheckBox = count($dangKy);
                $goiDangKy = implode($dangKy);
                $sql_signUp_package = "UPDATE `userfitness` SET `goi_dang_ky`='$goiDangKy' WHERE tenNguoiDung =" ."'" .$_SESSION['user']."'";
                if($demSoCheckBox == 1){
                if($conn->query($sql_signUp_package)){
                    echo "Bạn đã đăng ký thành công";
                }
                }
                if($demSoCheckBox > 1){
                echo "Bạn chỉ được chọn một gói";
                }
            }else{
                echo 'Bạn chưa chọn gói nào!';
            }
            
            
        }
        $conn->close();
    }  
    ?>

</body>

</html>