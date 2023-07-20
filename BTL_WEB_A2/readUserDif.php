<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded&display=swap" rel="stylesheet">
    <style>
    * {
        font-family: 'Unbounded', cursive;
    }
    </style>
    <script src="assets/js/dragImagePost.js"></script>
    <title>Đọc thông tin của người dùng</title>
</head>

<body>
    <?php
require 'conn.php';
session_start();?>
<?php 
    if(!isset($_SESSION['user'])){
        header('location:logInValidation.php');
} else {

    ?>
    <div class="app">
        <nav class="app__nav--menu">
        <div class="app__nav--logoAndSearch">
                <a href="" class="app__nav--logo-link">
                    <i class="fa-solid fa-blog"></i>
                </a>
                <form action="saveSearchData.php" method="post">
                    <input type="text" name= 'searchData' list="items" class="app__nav--search" placeholder="Tìm kiếm người dùng">
                    
                    <button type="submit" name="searchBtn" class="app__nav--searchBtn"> 
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                <datalist id="items">
                <?php
                     $sqlReadUser = "SELECT * FROM `users` WHERE username != '".$_SESSION['user']."'";
                     $resultReadUser = $conn->query($sqlReadUser);
                     if($resultReadUser->num_rows > 0){
                     while ($rowReadUser = $resultReadUser->fetch_assoc()){
                         
                    ?>
                    <option value="<?php echo $rowReadUser['username']?>"></option>
                    <?php
                     }   
                    }?>
                </datalist>
            </div>
            <div class="app__nav--MenuHeight">
                <ul class="app__nav--list">
                    <li class="app__nav--item">
                        <a href="trangChu.php" class="app__nav--link"><i class="fa-solid fa-house-user"></i>Trang
                            chủ</a>
                    </li>
                    <li class="app__nav--item">
                        <a href="readInforUser.php" class="app__nav--link"><i class="fa-solid fa-circle-info"></i>Cá
                            nhân</a>
                    </li>
                    <li class="app__nav--item">
                        <a href="friendNotifications.php" class="app__nav--link"><i class="fa-solid fa-user-group"></i>Bạn bè</a>
                    </li>
                    <li class="app__nav--item">
                        <a href="removeUserAcc.php" class="app__nav--link"><i class="fa-solid fa-trash"></i>Tự hủy</a>
                    </li>
                    <li class="app__nav--item">
                        <a href="logOut.php" class="app__nav--link"><i class="fa-solid fa-right-from-bracket"></i>Đăng
                            xuất</a>
                    </li>

                </ul>
            </div>
            <div class="app__nav--manageRegistration app__nav--ReginstrationNotEmpty">
                <ul class='app__nav--ReginstrationNotEmpty-list'>
                    <?php
                    $userNameLog = $_SESSION['userDif'];
                    $sql = "SELECT * FROM `users` WHERE username = '$userNameLog';";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $image_data_hex = $row['user_image'];
                        $image_data = pack('H*', $image_data_hex);
                        $image_data_base64 = base64_encode($image_data);
                        echo "<a href='' class='app__nav--ReginstrationNotEmpty-link'>";
                        echo "<li class='app__nav--ReginstrationNotEmpty-item'>";
                        echo $userNameLog;
                        echo "</li>";
                        echo "<li class='app__nav--ReginstrationNotEmpty-item'>";
                        echo "<img src='data:image/jpeg;base64,$image_data_base64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>";
                        echo "</li>";
                        echo "</a>";
                    }
                    ?>
                    <div class="app__nav--ReginstrationNotEmpty-action">
                        <h3>Một số tùy chỉnh:</h3>
                        <ul class="app__nav-action-item">
                            <li class="app__nav-action-item">
                                <i class="fa-solid fa-toggle-off"></i>
                                <!-- <i class="fa-solid fa-toggle-on"></i> -->
                                Đổi màu
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </nav>

        <main class="app__mainOfUser app__mainOfUser-tableInfo">
            <div class="infoPersonal">
                <div class="edditingInfo">
                <h1>Thông tin tài khoản của bạn</h1>
                    <a href="" class="edditingInfo-link">Reload</a>
                </div>
                <hr>
                <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Mã định danh:
                    <?php echo $row['user_id'] ?></p>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Ảnh người dùng:
                        <?php echo "<img src='data:image/jpeg;base64,$image_data_base64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>"; ?>
                    </p>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Tên người dùng:
                        <?php echo $row['username'] ?></p>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Email:
                        <?php echo $row['email'] ?></p>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Số điện thoại:
                        <?php echo $row['SĐT'] ?></p>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Mô tả bản thân:
                        <?php echo $row['bio'] ?></p>
                </div>
                <hr>
             
        </main>

    </div>


</body>
<?php }?>
</html>