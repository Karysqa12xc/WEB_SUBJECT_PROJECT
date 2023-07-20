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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/dragImagePost.js"></script>
    <script src="assets/js/ajaxLikeOfTablePosts.js"></script>
    <!-- <script src="assets/js/displayButtonFriend.js"></script>
    <script src="assets/js/ajaxAddFriend.js"></script> -->
    <title>Trang chủ</title>
</head>
<!-- Vùng trang chủ khi chưa tồn tại tài khoản user -->
<?php
    require 'conn.php';
    session_start();
    ?>
<?php
    if(!isset($_SESSION['user'])){
    ?>

<body>
    <div class="app">
        <nav class="app__nav--menu">
            <div class="app__nav--logoAndSearch">
                <a href="" class="app__nav--logo-link">
                    <i class="fa-solid fa-blog"></i>
                </a>
                <!-- <input type="text" class="app__nav--search" placeholder="Tìm kiếm người dùng"> -->
            </div>
            <div class="app__nav--manageRegistration">
                <ul class="app__nav--manageRegistration-list">
                    <li class="app__nav--manageRegistration-item">
                        <a href="logInValidation.php" class="app__nav--manageRegistration-link">
                            Đăng nhập
                        </a>
                        <span> | </span>
                        <a href="signUpValidation.html" class="app__nav--manageRegistration-link">
                            Đăng ký
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main>
            <h1 style="text-align: center; margin: 100px 30px;">Bạn cần đăng nhập để sử dụng các chức năng!!!!</h1>
        </main>
        <footer>
        </footer>
    </div>

</body>
<?php 
    }?>
<!-- Vùng trang chủ khi có tài khoản user -->
<?php
    if(isset($_SESSION['user'])){
    ?>

<body>
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
                        <a href="friendNotifications.php" class="app__nav--link"><i
                                class="fa-solid fa-user-group"></i>Bạn bè</a>
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

        <main class="app__mainOfUser">
            <div class="app__mainOfUser-contentLeft">
                <section class="app__contentLeft-top">
                    <h2>Gợi ý kết bạn</h2>
                    <?php
                    $sqlOfFriends = "SELECT * FROM `users` WHERE username != '$userNameLog' ORDER BY RAND() LIMIT 2;";
                    $resultOfFriends = $conn->query($sqlOfFriends);
                    if ($resultOfFriends->num_rows > 0) {
                        while ($rowOfFriends = $resultOfFriends->fetch_assoc()) {
                            $friendId = $rowOfFriends['user_id']
                    ?>
                    <div class="app__contentLeft-top-total">
                        <div class="app__contentLeft-top-list">
                            <?php
                            $image_dataFriends_hex = $rowOfFriends['user_image'];
                            $image_dataFriends = pack('H*', $image_dataFriends_hex);
                            $image_dataFriends_base64 = base64_encode($image_dataFriends);
                            echo "<img src='data:image/jpeg;base64,$image_dataFriends_base64' class ='app__contentLeft-top-image' alt='Ảnh đại diện'>";
                        ?>
                            <div class="app__contentLeft-top-descriptOfFriends">
                                <?php echo "<h1>" . $rowOfFriends['username'] . "</h1>";?>
                                <form action="addFriend.php" method="post" class="app__contentLeft-top-Form">
                                    <input type="hidden" name="userNameOfFriend" class="userNameIdOfFriends"
                                        value="<?php echo $friendId?>">
                                    <?php

                                    $sqlCheckFriend = "SELECT * FROM `friends` WHERE user_id = '$userId'  AND friend_id IN('$friendId')";
                                    $resultCheckFriend = $conn->query($sqlCheckFriend);
                                    if($resultCheckFriend->num_rows > 0){
                                        echo "<h1 class= 'notice'>Đã gửi</h1>"
                                    ?>

                                    <?php
                                    } else {
                                        ?>
                                    <input type="submit" value="Kết bạn" name="sendMsgAddFriend" class="btn_AddFriend">
                                    <?php }?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php }
                    }?>
                </section>
                <hr style="z-index: -99; width: 90%; margin-left: 0;">
                <section class="app__contentLeft-down">
                    <footer>
                        <ul class="app__contentLeft-footer-list">
                            <li class="app__contentLeft-footer-item">
                                <a href="#" class="app__contentLeft-footer-link">Liên hệ với chúng tôi</a>
                            </li>
                            <li class="app__contentLeft-footer-item">
                                <a href="#" class="app__contentLeft-footer-link">Điều khoản</a>
                            </li>
                            <li class="app__contentLeft-footer-item">
                                <a href="#" class="app__contentLeft-footer-link">Quảng cảo</a>
                            </li>
                            <li class="app__contentLeft-footer-item">
                                <a href="#" class="app__contentLeft-footer-link">Lựa chọn quảng cáo</a>
                            </li>
                        </ul>
                    </footer>
                </section>
            </div>
            <div class="app__mainOfUser-contentRight">
                <section class="app__contentRight-top">
                    <h1>Các công cụ được dùng để hoàn thiện trang web này</h1>
                    <ul class="app__contentRight-Sponsor-list">
                        <li class="app__contentRight-Sponsor-item">
                            <a href="https://www.apachefriends.org/" class="app__contentRight-Sponsor-link">
                                <img src="assets/images/Sponsor_1.jpg" alt="Ảnh nhà tài trợ"
                                    class="app__contentRight-Sponsor-img">
                                XAMPP
                            </a>
                        </li>
                        <li class="app__contentRight-Sponsor-item">
                            <a href="https://code.visualstudio.com/" class="app__contentRight-Sponsor-link">
                                <img src="assets/images/Sponsor_2.jpg" alt="Ảnh nhà tài trợ"
                                    class="app__contentRight-Sponsor-img">
                                VS CODE
                            </a>
                        </li>
                    </ul>
                </section>
                <hr>
                <section class="app__contentRight-down">
                    <h1>Bạn bè của bạn</h1>
                    <?php 
                        $sqlReadAllOfFriends = "SELECT * FROM `friends`, users WHERE ((friends.user_id = $userId AND status = 'Đã là bạn bè') OR (friends.friend_id = $userId)) AND (friends.user_id = users.user_id OR friends.friend_id = users.user_id) AND users.user_id != $userId GROUP BY users.user_id;";
                        $resultReadAllOfFriends = $conn->query($sqlReadAllOfFriends);
                        if($resultReadAllOfFriends->num_rows>0){
                            while($rowReadAllOfFriends = $resultReadAllOfFriends->fetch_assoc()){    
                                $image_dataFriendOfUser_hex = $rowReadAllOfFriends['user_image'];
                                $image_dataFriendOfUser = pack('H*', $image_dataFriendOfUser_hex);
                                $image_dataFriendOfUser_base64 = base64_encode($image_dataFriendOfUser); 
                                
                    ?>

                    <hr>
                    <div class="app__contentRight-displayAllFriendOfUser">
                        <?php echo "<img src='data:image/jpeg;base64,$image_dataFriendOfUser_base64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>";?>
                        <h2 style="flex: 1;"><?php echo $rowReadAllOfFriends['username']?></h2>
                        <p style="color: green; margin-right: 15px;">Bạn bè</p>
                    </div>

                    <?php
                       }
                    }?>
                </section>
            </div>
            <div class="app__mainOfUser-contentMid">
                <a href="#addPost" class="app__contentMid-postPage">
                    <div class="app__contentMid-addPostLink">
                        <ul class="app__contentMid-addPostLink-list">
                            <li class="app__contentMid-addPostLink-item">
                                <?php
                                    echo "<img src='data:image/jpeg;base64,$image_data_base64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>";
                                ?>
                            </li>
                            <li class="app__contentMid-addPostLink-item">
                                <p><?php echo "$userNameLog"?> ơi! Bạn đang nghĩ gì thế?</p>
                            </li>
                        </ul>
                    </div>
                </a>

                <!-- Bảng đăng bài -->
                <div class="app__contentMid-addPost" id="addPost">
                    <div class="app__contentMid-title">
                        <h2>Tạo bài viết</h2>
                        <a href="" class="app__contentMid-title-close">x</a>
                    </div>
                    <hr>
                    <div class="app__contentMid-image">
                        <?php echo "<img src='data:image/jpeg;base64,$image_data_base64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>";
                        echo "$userNameLog";
                        ?>
                    </div>
                    <?php
                    if(isset($_POST['sendDataPost'])){
                        $image = $_FILES['imageUpload'];
                        $imageData = file_get_contents($image['tmp_name']);  
                        $imagePostData = bin2hex($imageData);
                        $content_post = $_POST['contentPost'];
                        $sqlInsertImage = "INSERT INTO `posts`(`user_id`, `content`, `image`) VALUES ('$userId','$content_post','$imagePostData')";   
                        $conn->query($sqlInsertImage);
                        // if (isset($_FILES['imageUpload'])) {
                        // }   
                    }else{
                        echo "<h1 style= 'margin: 15px 180px;'>Chưa tồn tại file ảnh</h1>";
                    }
                ?>
                    <form action="" method="POST" class="app__contentMid-form" enctype="multipart/form-data">
                        <input type="text" class="app__contentMid-contentPost" name="contentPost"
                            placeholder="<?php echo "$userNameLog"?> bạn đanh nghĩ gì vậy?">
                        <div class="app__contentMid-fieldImage">
                            <header id="app__contentMid-DragImage">Hiển thị hình ảnh</header>
                        </div>
                        <input type="file" name="imageUpload" class="app__contentMid-chooseImage">
                        <input type="submit" name="sendDataPost" value="Đăng" class="app__contentMid-submitImage">
                        <button class="app__contentMid-disableImage">Hủy bỏ</button>
                    </form>
                </div>
                <!-- Bài đã được đăng -->
                <?php
                $sqlReadAllDataOfPosts = 'SELECT * FROM `posts` WHERE 1 ORDER BY timestamp DESC;';
                $resultOfPost = $conn->query($sqlReadAllDataOfPosts);
                $sqlSelectNameUserRefPost = "SELECT users.username , users.user_image FROM `posts`, users WHERE posts.user_id = users.user_id ORDER BY posts.timestamp DESC;";
                $resultSelectNameUserRefPost = $conn->query($sqlSelectNameUserRefPost);
                if($resultOfPost->num_rows > 0 && $resultSelectNameUserRefPost->num_rows > 0){
                    while($rowOfPost = $resultOfPost->fetch_assoc()){
                    $rowSelectNameUserRefPost = $resultSelectNameUserRefPost->fetch_assoc();
                    $rowImageOfPost = $rowOfPost['image'];
                    $rowImageOfPostdata = pack('H*', $rowImageOfPost);
                    $rowImageOfPostBase64 = base64_encode($rowImageOfPostdata);
                    $rowImgOfUser = $rowSelectNameUserRefPost['user_image'];
                    $rowImageOfUserData = pack('H*',  $rowImgOfUser);
                    $rowImageOfUserBase64 = base64_encode($rowImageOfUserData);
                    echo "<div class='app__contentMid-displayPost'>";
                ?>
                <section class="app__displayPost-title">
                    <a href="" class="app__displayPost-link">
                        <?php echo"<img src='data:image/jpeg;base64,$rowImageOfUserBase64' class='app__nav--imageRepresent' alt='Ảnh đại diện'>";?>
                        <?php  
                            echo "<h1>".$rowSelectNameUserRefPost['username']."</h1>";  
                        ?>

                    </a>
                    <?php
                            $post_id = $rowOfPost['post_id'];
                            if(isset($_POST['EditContentOfPost'])){
                                $post_content = $_POST['app__displayPostSetting-content'];
                                $post_each_id = $_POST['postSetting_id'];
                                if($post_each_id == $post_id){
                                    $sqlEditContentOfPost = "UPDATE `posts` SET `content`='$post_content' WHERE `post_id`='$post_each_id'";
                                    if($conn->query($sqlEditContentOfPost)){
                                        echo "<h3>Sửa thành công bấm vào reload để hoàn thành</h3>";
                                    }
                                }
                            }
                            if(isset($_POST['RemovePost'])){
                                $post_each_id = $_POST['postSetting_id'];
                                if($post_each_id == $post_id){
                                    $sqlRemoveContentOfPost = "DELETE FROM `posts` WHERE `post_id`='$post_each_id'";
                                    if($conn->query($sqlRemoveContentOfPost)){
                                        echo "<h3>Xóa thành công bấm vào thoát để hoàn thành</h3>";
                                    }
                                }
                            }
                        ?>
                    <?php 
                        if($_SESSION['user'] == $rowSelectNameUserRefPost['username']){
                    ?>
                    <div class="app__displayPostSetting-element">
                        <ul class="app__displayPostSetting-list">
                            <li class="app__displayPostSetting-item">
                                <a href="#app__displayPostSettingTarget_<?php echo $post_id;?>"
                                    class="app__displayPostSetting-link">Chỉnh sửa
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="app__displayPostSetting-element">
                        <ul class="app__displayPostSetting-list">
                            <li class="app__displayPostSetting-item">
                                <a href="#app__displayPostSettingTargetRemovePost_<?php echo $post_id;?>"
                                    class="app__displayPostSetting-link">
                                    Xóa bài
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php }?>

                    <h1><?php echo $rowOfPost['content']?></h1>
                    <form action="" method="POST" id="app__displayPostSettingTarget_<?php echo $post_id;?>"
                        class="app__displayPostSetting-Form">
                        <input type="hidden" name="postSetting_id" class="app__displayPostID"
                            value="<?php echo $post_id; ?>">
                        <input type="text" name="app__displayPostSetting-content">
                        <button type="submit" class="app__displayPostSetting-btn" name="EditContentOfPost">Sửa</button>
                        <a href="" class="app__displayPostSetting-close">Reload</a>
                    </form>
                    <form action="" method="POST" id="app__displayPostSettingTargetRemovePost_<?php echo $post_id;?>"
                        class="app__displayPostSetting-FormRemove">
                        <input type="hidden" name="postSetting_id" class="app__displayPostID"
                            value="<?php echo $post_id; ?>">
                        <h1>Bạn chắc chứ?</h1>
                        <button type="submit" class="app__displayPostSetting-btn" name="RemovePost">Chắc</button>
                        <a href="" class="app__displayPostSetting-close">Thoát</a>
                    </form>

                </section>
                <hr>
                <section class="app__displayPost-content">
                    <?php echo "<img src='data:image/jpeg;base64,$rowImageOfPostBase64' class='app__contentMid-displayPost-image' alt='Ảnh bài đăng'>";?>
                </section>
                <hr>
                <section class="app__displayPost-likeAndCmt">
                    <form action="" method="POST" class="app__displayPostForm">
                        <input type="hidden" name="post_id" class="app__displayPostID"
                            data-post-id="<?php echo $rowOfPost['post_id']; ?>"
                            value="<?php echo $rowOfPost['post_id']; ?>">
                        <button type="submit" class="app__displayPost-like" name="like">
                            <i class="fa-regular fa-thumbs-up"></i>
                            <?php echo "<p class = 'app__displayPost-countLike'>" . $rowOfPost['likes'] . "</p>";?>
                        </button>
                    </form>
                </section>
            </div>
            <?php
            }
        }
    $conn->close();?>
    </div>


    </div>
    </main>


</body>
<?php 
}?>

</html>