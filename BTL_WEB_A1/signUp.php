<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        body{
            font-family: 'Courier New', Courier, monospace;
            font-size: 25px;
        }
        input{
            font-family: 'Courier New', Courier, monospace;
            font-size: 25px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Đăng ký</h1>
        <form action="" method="POST">
            <label for="userName">Tên tài khoản: </label>
            <input type="text" name="userName" id="" placeholder="Nhập tên của bạn"><br>
            <label for="pass">Mật khẩu: </label>
            <input type="password" name="pass" id="" placeholder="Nhập mật khẩu của bạn"><br>
            <label for="re_password">Nhập lại mật khẩu: </label>
            <input type="password" name="re_password" id="" placeholder = "Nhập lại mật khẩu của bạn"><br>
            <label for="E_mail">Email: </label>
            <input type="email" name="E_mail" id="" placeholder="xx...xx@gmail.com"><br>
            <label for="phoneNumber">Số điện thoại: </label>
            <input type="tel" name="phoneNumber" placeholder="0xxx-xxx-xxx" id="" pattern="[0-9]{4}-[0-9]{3}-[0-9]{3}"><br>
            <label for="address">Địa chỉ: </label>
            <input type="text" name="address" id="" placeholder="Nhập địa chỉ của bạn"><br>
            <input type="submit" name="dangky" value="Đăng ký">
        </form>
    </div>
    <?php
    require 'connectDB.php';
    mysqli_set_charset($conn, 'UTF8');
    if(isset($_POST['dangky'])){    
        $userName = $_POST['userName'];
        $passWord = $_POST['pass'];
        $re_pass = $_POST['re_password'];
        $Email = $_POST['E_mail'];
        $phone_number = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $sql_checkDuplicate = "SELECT * FROM `userfitness` WHERE 1";
        $result = $conn->query($sql_checkDuplicate);
        if($result->num_rows > 1){
            while($row = $result->fetch_assoc()){
                if($userName == $row['tenNguoiDung']){
                    echo "tên người dùng đã tồn tại";
                    die();
                }     
            }
            if($passWord == $re_pass){
                $sql =  "INSERT INTO `userfitness`(`tenNguoiDung`, `password`, `email`, `soDienThoai`, `address`, `goi_dang_ky`, `chuc_vu`) 
                VALUES ('$userName','$passWord','$Email','$phone_number',' $address', 'Chưa đăng ký', '2')";
                $conn->query($sql);
                echo "Bạn đã đăng ký thành công" . " click vào đây để đăng nhập: " . "<a href = 'logIn.php'>Click here</a>";
            }else{
                echo "Mật khẩu bạn nhập lại không khớp";
            }
            $conn->close();
        }
      
    }
    ?>

</body>

</html>