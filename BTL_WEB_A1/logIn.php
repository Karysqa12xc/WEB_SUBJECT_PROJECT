<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body{
            font-family: 'Courier New', Courier, monospace;
            font-size: 25px;
        }
        input{
            font-family: 'Courier New', Courier, monospace;
            font-size: 25px;
        }
        button{
            font-family: 'Courier New', Courier, monospace;
        }
        a{
            font-size: 25px;
        }
    </style>
        
    
</head>

<body>
    <div class="container">
        <h1>Đăng nhập</h1>
        <form action="" method="POST">
            <label for="userName">Tên tài khoản: </label>
            <input type="text" placeholder="Nhập tên tài khoản của bạn" name='userName'><br>
            <label for="pass">Mật khẩu: </label>
            <input type="password" name="pass" id="" placeholder="Nhập mật khẩu"><br>
            <input type="submit" value="Đăng nhập" name="dangnhap">
            <button>
                <a style="text-decoration: none; color: black;" href="signUp.php">Đăng ký</a>
            </button>
        </form>
    </div>
    <?php
        require 'connectDB.php';
        mysqli_set_charset($conn, 'UTF8');
        session_start();
        if(isset($_POST['dangnhap'])){
            $user_name =  $_POST['userName'];
            $password =  $_POST['pass'];
            $sql = "SELECT * FROM `userfitness` WHERE tenNguoiDung = '$user_name' AND userfitness.password = '$password'";
            $_SESSION['user'] = $user_name;
            $result = $conn->query($sql);
            if($result->num_rows == 1){
                header('location:TrangChu.php');//Sử dụng để chuyển hưởng trang
            }else{
                echo "Bạn đã nhập sai tên tài khoản hoặc mật khẩu hoặc bạn chưa có tài khoản";
            }
        }
        $conn->close();
    ?>
</body>

</html>