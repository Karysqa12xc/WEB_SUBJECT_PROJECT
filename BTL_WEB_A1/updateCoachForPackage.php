<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân công các Coach cho mỗi gói tập</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
    }

    form {
        display: flex;
        flex-wrap: wrap;
    }

    caption {
        font-size: 25px;
        margin: 0 auto;
    }

    table {
        width: 100%;
    }

    input {
        margin: 15px auto;
        width: 250px;
    }

    tr {
        text-align: center;
    }

    select {
        width: 95%;
    }

    option {
        text-align: center;
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
    
    <form method="POST">
        <?php
    require 'connectDB.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:logIn.php');
    }
    else{
        $sql_package = "SELECT * FROM `trailing_schedule` WHERE goi_tap != 'Chưa đăng ký'";
        $sql_coach = "SELECT * FROM `userfitness` WHERE chuc_vu = 1";
    }
    ?>
        <table border="1">
            <caption><b>Phân Coach phụ trách cho Package</b></caption>
            <tr>
                <th>Tên Coach</th>
                <th>Tên gói</th>
            </tr>
            <tr>
                <td>
                    <Select name="tenCoach">
                        <?php
                         $result_coach = $conn->query($sql_coach);
                         if($result_coach->num_rows > 0){
                             while($row_coach = $result_coach->fetch_assoc()){
                                $tenCoach = $row_coach['tenNguoiDung'];
                                     if($tenCoach == $_POST['tenCoach'] && isset($_POST['tenCoach'])){
                                    echo "<option value='$tenCoach' selected>$tenCoach</option>";
                                     }else{
                                        echo "<option value='$tenCoach'>$tenCoach</option>";
                                     }
                             }   
                         }
                        ?>
                    </Select>
                </td>
                <td>
                    <Select name="tenGoi">
                        <?php
                      $result_package = $conn->query($sql_package);
                      if($result_coach->num_rows > 0){
                          while($row_package = $result_package->fetch_assoc()){
                             $tenPackage = $row_package['goi_tap'];
                                  if($tenPackage == $_POST['tenGoi'] && isset($_POST['tenGoi'])){
                                 echo "<option value='$tenPackage' selected>$tenPackage</option>";
                                  }else{
                                     echo "<option value='$tenPackage'>$tenPackage</option>";
                                  }
                          }   
                      }
                        ?>
                    </Select>
                </td>
            </tr>
        </table>
        <input type="submit" name="Add" value="Xác nhận">
    </form>

    <?php
    if(isset($_POST['Add'])){
        $tenOfCoach = $_POST['tenCoach'];
        $tenOfPackage = $_POST['tenGoi'];
        $sql_u_coach_for_package = "UPDATE `trailing_schedule` SET `Coach`='$tenOfCoach' WHERE goi_tap ='$tenOfPackage'";
        if ($conn->query($sql_u_coach_for_package)){
            echo "Thành công!";
        }else{
            echo "Có lỗi";
        }
    }
    ?>
</body>

</html>