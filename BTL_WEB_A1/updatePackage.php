<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa pakage</title>
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
        padding: 20px;
    }

    input {
        font-family: 'Courier New', Courier, monospace;
    }

    .del_btn {
        width: 10%;
    }

    .insert_btn {
        width: 96%;
        height: 100px;
        font-size: 20px;
    }

    tr {
        text-align: center;
    }

    .tr_input {
        height: 100px;
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
    </style>
</head>

<body>
    <a href="TrangChu.php">
        <-back</a>
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

            <?php
      require 'connectDB.php';
      session_start();
      if(!isset($_SESSION['user'])){
          header('location:logIn.php');
 } else {
     echo "<div class = 'container'>";
     echo "<h1 class = 'title_header'>Sửa đổi gói tập</h1>";
     if(isset($_POST['Add'])){
        $goiTap = $_POST['goiTap'];
        $thuHai = $_POST['thuhai'];
        $thuBa = $_POST['thuba'];
        $thuTu = $_POST['thutu'];
        $thuNam = $_POST['thunam'];
        $thuSau = $_POST['thusau'];
        $thuBay = $_POST['thubay'];
        $chuNhat = $_POST['chunhat'];
        $gia = $_POST['gia'];
      
        $sql_insert_package = "INSERT INTO `trailing_schedule`(`goi_tap`, `thu_hai`, `thu_ba`, `thu_tu`, `thu_nam`, `thu_sau`, `thu_bay`, `chu_nhat`, `Gia`) VALUES ('$goiTap','$thuHai','$thuBa','$thuTu','$thuNam','$thuSau','$thuBay','$chuNhat','$gia')";
        $sql_checkDuplicate = "SELECT * FROM `trailing_schedule` WHERE 1";
        $result = $conn->query($sql_checkDuplicate);
            if ($result->num_rows > 1) {
                while ($row = $result->fetch_assoc()) {
                        if ($goiTap == $row['goi_tap']) {
                                echo "Gói tập đã tồn tại hoặc bạn đã để trống khi thêm";
                                echo "<a href = 'updatePackage.php'>Reload</a>";
                                die();
                        }
                }
            }
            if($conn->query($sql_insert_package)){
                    echo "Thêm thành công";
            }
 }
     echo "</div>";
     if(isset($_POST['del'])){
        $Del_package = $_POST['package'];
        if(isset($Del_package)){
            $demSoCheckBox = count($Del_package);
            $goiXoa = implode($Del_package);
            $sql_delete_package = "DELETE FROM `trailing_schedule` WHERE goi_tap = '$goiXoa'";
            if($demSoCheckBox == 1){
            if($conn->query($sql_delete_package)){
                echo "Bạn đã xóa thành công";
            }
            }
            if($demSoCheckBox > 1){
            echo "Bạn chỉ được xóa một gói trong một lần";
            }
        }else{
            echo 'Bạn chưa chọn gói nào!';
        } 
    }
    if(isset($_POST['update'])){
        $update_package = $_POST['package'];
        $thuHai = $_POST['thuhai'];
        $thuBa = $_POST['thuba'];
        $thuTu = $_POST['thutu'];
        $thuNam = $_POST['thunam'];
        $thuSau = $_POST['thusau'];
        $thuBay = $_POST['thubay'];
        $chuNhat = $_POST['chunhat'];
        $gia = $_POST['gia'];
        if(isset($update_package)){
            $demSoCheckBox = count($update_package);
            $goiUpdate = implode($update_package);
            $sql_update_package = "UPDATE `trailing_schedule` SET `thu_hai`='$thuHai ',`thu_ba`='$thuBa',`thu_tu`='$thuTu',`thu_nam`='$thuNam',`thu_sau`='$thuSau',`thu_bay`='$thuBay',`chu_nhat`='$chuNhat',`Gia`='$gia' WHERE `goi_tap`='$goiUpdate'";
            if($demSoCheckBox == 1){
            if($conn->query($sql_update_package)){
                echo "Bạn đã sửa thành công";
            }
            }
            if($demSoCheckBox > 1){
            echo "Bạn chỉ được chọn một gói để sửa";
            }
        }else{
            echo 'Bạn chưa chọn gói nào!';
        } 
    }
     $sql = "SELECT * FROM `trailing_schedule` WHERE trailing_schedule.goi_tap != 'Chưa đăng ký' AND trailing_schedule.goi_tap != ''";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
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
              <td>Xóa</td>
          </tr>";
         while ($row = $result->fetch_assoc()) {
             echo "<tr>
                  <th>" . $row['goi_tap'] . "</th>
                  <th>" . $row['thu_hai'] . "</th>
                  <th>" . $row['thu_ba'] . "</th>
                  <th>" . $row['thu_tu'] . "</th>
                  <th>" . $row['thu_nam'] . "</th>
                  <th>" . $row['thu_sau'] . "</th>
                  <th>" . $row['thu_bay'] . "</th>
                  <th>" . $row['chu_nhat'] . "</th>
                  <th>" . $row['Gia'] . "</th>
                  <th><input type='checkbox' name = 'package[]' value = '" . $row['goi_tap'] . "'></th>
              </tr>";
         }
         echo "<tr class ='tr_input'>
         <th><input class ='insert_btn' type='text' name='goiTap'></th>
         <th><input class ='insert_btn' type='text' name='thuhai'></th>
         <th><input class ='insert_btn' type='text' name='thuba'></th>
         <th><input class ='insert_btn' type='text' name='thutu'></th>
         <th><input class ='insert_btn' type='text' name='thunam'></th>
         <th><input class ='insert_btn' type='text' name='thusau'></th>
         <th><input class ='insert_btn' type='text' name='thubay'></th>
         <th><input class ='insert_btn' type='text' name='chunhat'></th>
         <th><input class ='insert_btn' type='text' name='gia'></th>
         <th><input class ='insert_btn' type='submit' name='Add' value = 'Thêm'></th>
     </tr>";
         echo "<input class ='del_btn' type='submit' name='del' value= 'Xóa gói tập'>";
         echo "<input class ='del_btn' type='submit' name='update' value= 'Sửa gói tập'>";
         echo "</form>";
         echo "</table>";
     }
    $conn->close();
 }
 ?>
</body>

</html>