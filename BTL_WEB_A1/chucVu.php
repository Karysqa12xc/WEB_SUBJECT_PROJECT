<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chức vụ</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
    }

    table {
        width: 100%;
        font-size: 25px;
    }

    td {
        text-align: center;
    }

    input {
        font-family: 'Courier New', Courier, monospace;
        width: 99%;
        font-size: 25px;
    }

    .submit__btn {
        width: 50%;
        margin: 25px 0 0 340px;
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
    <form method="POST">
        <h1>Các chức vụ trong trang Web</h1>
        <table border="1">
            <caption><b>Bảng chức vụ</b></caption>
            <tr>
                <th>ID chức vụ</th>
                <th>Tên chức vụ</th>
                <th>Xóa</th>

            </tr>
            <?php
            require "connectDB.php";
            session_start();
            if(!isset($_SESSION['user'])){
                header('location:logIn.php');
            }else{
                if(isset($_POST['Add'])){
                    $ID_chuc_vu = $_POST['ID'];
                    $ten_chuc_vu = $_POST['tenChucVu'];
                    $sql = "INSERT INTO `chuc_vu`(`idChucVu`, `tenChucVu`) VALUES ('$ID_chuc_vu','$ten_chuc_vu ')";
                    $sql_checkDuplicate = "SELECT * FROM `chuc_vu` WHERE 1";
                    $result = $conn->query($sql_checkDuplicate);
                    if ($result->num_rows > 1) {
                        while ($row = $result->fetch_assoc()) {
                            if ($ID_chuc_vu == $row['idChucVu']) {
                                echo "Id đã tồn tại";
                                echo "<br><a href = 'chucVu.php'>Reload</a>";
                                die();
                            }
                        }
                    }
                    if($conn->query($sql)){
                        echo "Thêm thành công";
                    }
                }
                if(isset($_POST['Delete'])){
                    $checkDel = $_POST['xoaChucVu'];
                    $checkDelStr = implode(",", $checkDel);
                    $sql_delete = "DELETE FROM `chuc_vu` WHERE idChucVu IN($checkDelStr)";
                    if($conn->query($sql_delete)){
                        echo "Xóa thành công";
                    }
                }
                $sql_All_Data = "SELECT * FROM `chuc_vu` WHERE idChucVu != ''";
                $result = $conn->query($sql_All_Data);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<th>" . $row['idChucVu'] . "</th>";
                        echo "<th>" . $row['tenChucVu'] . "</th>";
                        echo "<th>"."<input type='checkbox' name='xoaChucVu[]' value="."'". $row['idChucVu'] ."'". "</th>";
                        echo "</tr>";
                    }
                }
                }
                $conn->close();
            ?>
            <tr>
                <td><input type="text" name="ID"></td>
                <td><input type="text" name="tenChucVu"></td>
                <td>Thêm chức vụ</td>
                
            </tr>
        </table>
        <input class="submit__btn" type="submit" name="Add" value="Thêm dữ liệu">
        <input class="submit__btn" type="submit" name="Delete" value="Xóa dữ liệu">
    </form>
</body>

</html>