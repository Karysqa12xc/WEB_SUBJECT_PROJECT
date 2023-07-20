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
        *{
            font-family: 'Unbounded', cursive;
        }
    </style>
    <script src="assets/js/checkLogFrom.js"></script>
    <title>Đăng nhập</title>
</head>
<body>
<h1>Đây là nơi để bạn đăng nhập tài khoản!!!</h1>
        <div class="container container-logIn">
            <form action="loginWithDB.php" method="POST">
                <h2>Đăng nhập</h2>
                <div class="form__control">
                    <label for="" class="form__control-inpName">Tên người dùng: </label>
                    <input type="text" name="userLogIn" class="form_control-inp" placeholder="Nhập tên">
                    <span class="form_control-mgsError"></span>
                </div>
                <div class="form__control">
                    <label for="" class="form__control-inpName">Nhập mật khẩu: </label>
                    <div class="from__control-fiedldPass">
                        <input type="password" name="passLogIn" class="form_control-inp" id="passLog" placeholder="Nhập mật khẩu">
                        <i class="fa-solid fa-eye-slash eye-close"></i>
                        <i class="fa-solid fa-eye eye-open" style="display: none;"></i>
                    </div>
                    <span class="form_control-mgsError"></span>
                </div>
                <span class="container-msgErrorTotal"></span>
                <p>Nếu bạn chưa có tài khoản nhấp vào đây để <a href="signUpValidation.html" class="form__control-linkSignUp">Đăng ký</a></p> 
                <input type="submit" class="form__control-submit" id="sendDB" value="Đăng nhập">
            </form>
        </div>
        
</body>
</html>