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
    <title>Xem lời mời kết bạn</title>
    <style>
    * {
        font-family: 'Unbounded', cursive;

    }
    </style>
    <!-- <script src="assets/js/hiddenBtnAgree.js"></script> -->
</head>

<body>
    <?php require "conn.php";
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:logInValidation.php');
    }
?>
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
                    <a href="friendNotifications.php" class="app__nav--link"><i class="fa-solid fa-user-group"></i>Bạn
                        bè</a>
                </li>
                <li class="app__nav--item">
                    <a href="" class="app__nav--link"><i class="fa-solid fa-trash"></i>Tự hủy</a>
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
                if($result->num_rows > 0) {
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
                <h1>Các lời mời kết bạn</h1>
                <a href="" class="edditingInfo-link">Reload</a>
            </div>
            <hr>
            <?php
                    $sqlReadNoticeAddFriends = "SELECT * FROM `friends`, users WHERE friends.friend_id = $userId AND friends.user_id = users.user_id;";
                    $resultReadNoticeAddFriends = $conn->query($sqlReadNoticeAddFriends);
                    if ($resultReadNoticeAddFriends->num_rows > 0) {
                        while ($rowReadNoticeAddFriends = $resultReadNoticeAddFriends->fetch_assoc()) {
                    ?>
            <div class="editingInfo">
                <ul class="editingInfo-list">
                    <li class="editingInfo-item">
                        <?php
                $image_dataNoticeFriends_hex = $rowReadNoticeAddFriends['user_image'];
                $image_dataNoticeFriends = pack('H*', $image_dataNoticeFriends_hex);
                $image_dataNoticeFriends_base64 = base64_encode($image_dataNoticeFriends);
                echo "<img src='data:image/jpeg;base64,$image_dataNoticeFriends_base64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>";
                ?>
                        <div class="editingInfo-description">
                            <?php echo "<h1>".$rowReadNoticeAddFriends["username"]."</h1>"?>
                            <?php echo "<p style = 'color: var(--primary-color); font-size: 1.4rem'>".$rowReadNoticeAddFriends['status']."<p>"?>
                        </div>
                    </li>
                    <?php
                $friend_id = $rowReadNoticeAddFriends['user_id'];
                ?>
                    <li class="editingInfo-item">
                        <div class="editingInfo-Btn">
                            <?php
                        $sqlCheckAgree = "SELECT * FROM `friends` WHERE friend_id = $userId AND status = 'Đã là bạn bè';";
                        $resultCheckAgree  = $conn->query($sqlCheckAgree);
                            if ($resultCheckAgree->num_rows >= 0) {
                                $rowCheckAgree = $resultCheckAgree->fetch_assoc();
                                    if ($rowCheckAgree['status'] != $rowReadNoticeAddFriends['status']) {
                                        ?>
                            <form action="agreeFriends.php" method="POST" class="editingInfo-BtnAgree">
                                <input type="hidden" name="friendIdAgree" value="<?php echo $friend_id ?>">
                                <button type="submit" name="agree" class="BtnAgree">Đồng ý</button>
                            </form>
                            <form action="refuseFriend.php" method="POST" class="editingInfo-BtnRefuse">
                                <input type="hidden" name="friendIdRefuse" value="<?php echo $friend_id ?>">
                                <button type="submit" class="BtnRefuse">Từ chối</button>
                            </form>
                            <?php 
                                
                            }
                            }
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
            <hr>
            <?php   


        }
                }
            $conn->close();?>


        </div>



    </main>
</body>

</html>