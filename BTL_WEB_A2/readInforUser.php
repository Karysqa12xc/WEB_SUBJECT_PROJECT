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
                    $userNameLog = $_SESSION['user'];
                    $sql = "SELECT * FROM `users` WHERE username = '$userNameLog';";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $userId = $row['user_id'];
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
                    <a href="#eddtingImage" class="edditingInfo-link">Chỉnh sửa</a>
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
                        <a href="#eddtingEmail" class="edditingInfo-link">Chỉnh sửa</a>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Mật khẩu:
                        <?php echo $row['password'] ?></p>
                    <a href="#eddtingPass" class="edditingInfo-link">Chỉnh sửa</a>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Số điện thoại:
                        <?php echo $row['SĐT'] ?></p>
                    <a href="#eddtingPhone" class="edditingInfo-link">Chỉnh sửa</a>
                </div>
                <hr>
                <div class="edditingInfo">
                    <p style="color: var(--white-color);font-size: 1.8rem;padding-left: 30px;">Mô tả bản thân:
                        <?php echo $row['bio'] ?></p>
                    <a href="#eddtingBio" class="edditingInfo-link">Chỉnh sửa</a>
                </div>
                <hr>
                <div id="eddtingImage" class="eddtingImageBg">
                    <div class="edditingHandleImage">
                        <!-- Chỉnh sửa các thông tin cá nhân -->
                        <?php
                        //Sửa ảnh
                        if (isset($_POST['sendDataUser']) && !empty($_FILES['imageUploadUser'])) {
                            if (isset($_FILES['imageUploadUser'])) {
                                $image = $_FILES['imageUploadUser'];
                                $imageData = file_get_contents($image['tmp_name']);
                                $imageUserData = bin2hex($imageData);
                                $sqlUpdateImageOfUser = "UPDATE `users` SET `user_image`='$imageUserData' WHERE user_id = '$userId'";
                                $conn->query($sqlUpdateImageOfUser);
                                die();
                            }
                        }
                        //Sửa Email
                        if (isset($_POST['editEmail'])) {
                            $editEmail = $_POST['EditEmail'];
                            $sqlUpdateEmailOfUser = "UPDATE `users` SET `email`='$editEmail' WHERE user_id = '$userId'";
                            $conn->query($sqlUpdateEmailOfUser);
                            die();
                        }
                        //Sửa mật khẩu
                        if (isset($_POST['editPass'])) {
                            $editPass = $_POST['EditPass'];
                            $sqlUpdatePassOfUser = "UPDATE `users` SET `password`='$editPass' WHERE user_id = '$userId'";
                            $conn->query($sqlUpdatePassOfUser);
                            die();
                        }
                        //Sửa số điện thoại
                        if (isset($_POST['editPhone'])) {
                            $editPhone = $_POST['EditPhone'];
                            $sqlUpdatePhoneOfUser = "UPDATE `users` SET `SĐT`='$editPhone' WHERE user_id = '$userId'";
                            $conn->query($sqlUpdatePhoneOfUser);
                            die();
                        }
                        //Sửa mô tả bản thân
                        if (isset($_POST['editBio'])) {
                            $editBio = $_POST['EditBio'];
                            $sqlUpdatePhoneOfUser = "UPDATE `users` SET `bio`='$editBio' WHERE user_id = '$userId'";
                            $conn->query($sqlUpdatePhoneOfUser);
                            die();
                        }
                        ?>
                        <form action="" method="POST" style="color: #fff;" class="app__contentMid-form"
                            enctype="multipart/form-data">
                            <div class="app__contentMid-fieldImage">
                                <header id="app__contentMid-DragImage">Hiển thị hình ảnh</header>
                                <a href="" class="close">Bỏ chỉnh sửa</a>
                            </div>
                            <input type="file" name="imageUploadUser" class="app__contentMid-chooseImage">
                            <input type="submit" name="sendDataUser" value="Sửa" class="app__contentMid-submitImage">
                            <button class="app__contentMid-disableImage">Hủy bỏ</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="eddtingEmail" class="eddtingEmailBg">
                <div class="edditingHandleEmail">
                    <form action="" method="post">
                        <label for="">Sửa email:</label>
                        <input type="email" name="EditEmail" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"  required>
                        <input type="submit" value="Sửa" name="editEmail">
                    </form>
                    <a href="" class="close">Bỏ chỉnh sửa</a>
                </div>
            </div>
            <div id="eddtingPass" class="eddtingPassBg">
                <div class="edditingHandlePass">
                    <form action="" method="post">
                        <label for="">Sửa mật khẩu:</label>
                        <input type="text" name="EditPass"  pattern= "^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" required>
                        <input type="submit" value="Sửa" name="editPass">
                    </form>
                    <a href="" class="close">Bỏ chỉnh sửa</a>
                </div>
            </div>
            <div id="eddtingPhone" class="eddtingPhoneBg">
                <div class="edditingHandlePhone">
                    <form action="" method="post">
                        <label for="">Sửa số điện thoại:</label>
                        <input type="text" name="EditPhone" placeholder="0 + 9 số" pattern = "^(0[1-9]{1})+([0-9]{8})$" required>
                        <input type="submit" value="Sửa" name="editPhone" >
                    </form>
                    <a href="" class="close">Bỏ chỉnh sửa</a>
                </div>
            </div>
            <div id="eddtingBio" class="eddtingBioBg">
                <div class="edditingHandleBio">
                    <form action="" method="post">
                        <label for="">Sửa mô tả bản thân:</label>
                        <input type="text" name="EditBio">
                        <input type="submit" value="Sửa" name="editBio" required>
                    </form>
                    <a href="" class="close">Bỏ chỉnh sửa</a>
                </div>
            </div>
        </main>

    </div>


</body>
<?php }?>
</html>