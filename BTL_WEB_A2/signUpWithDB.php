<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/fromValidation.css">
    <link rel="stylesheet" href="assets/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded&display=swap" rel="stylesheet">
    <style>
    * {
        font-family: 'Unbounded', cursive;
    }
    </style>
    <title>Thông báo đã đăng ký thành công</title>
</head>

<body>
    <div class="container-NoticeOfSignUp">
        <?php
        require "conn.php";
        if (isset($_POST['send'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            $desciptOfUser = $_POST['desciption'];
            $imageDefaultData = file_get_contents("assets/uploads/defaultImage.png");
            $convertImageToHexStr = bin2hex($imageDefaultData);
            $sql_checkDuplicate = "SELECT * FROM `users`";
            $result_checkDuplicate = $conn->query($sql_checkDuplicate);
            if($result_checkDuplicate->num_rows > 0){
                while($rowCheck = $result_checkDuplicate->fetch_assoc()){
                    if($userName == $rowCheck['username'] || $email == $rowCheck['email']){
                        echo "<h2 class='container__notice'> <i class='fa-solid fa-triangle-exclamation' style='color: #f33a58;'></i> Tên người dùng hoặc email đã tồn tại!!!</h2>";
                        echo "<a href='signUpValidation.html' class='container__moveToLogin'>Quay lại</a>"; 
                        die();
                    }
                }
                $sql = "INSERT INTO `users`(`username`, `email`, `password`, `user_image`, `SĐT`, `bio`) 
                VALUES ('$userName','$email','$password','$convertImageToHexStr','$phoneNumber','$desciptOfUser')";
                $conn->query($sql);
                echo "<h2 class='container__notice'> <i class='fa-solid fa-circle-check' style='color: #38ef7d;'></i> Bạn đã đăng ký tài khoản thành công!!!</h2>";
                echo "<a href='logInValidation.php' class='container__moveToLogin'>Chuyển tiếp</a>";
            }
        }
    else{
        echo "<h2 class='container__notice'></h2>";
        echo "<a href='logInValidation.html' class='container__moveToLogin'></a>";
    }
        $conn->close();
    ?>
    </div>
</body>

</html>