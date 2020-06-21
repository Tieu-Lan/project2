<?php
function generateSalt()
{
    // 使用随机方式生成一个四位字符
    $str = "";
    $chars = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    for ($i = 0; $i < 32; $i++) {
        $str .= $chars[mt_rand(0, count($chars) - 1)];
    }
    return $str;
}
function generateHashPassword($password, $salt)
{
    return md5(sha1($password) . $salt);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="body">
    <h3 class="t">
        <?php
        $result = $_GET['result'];
        if ($result == 1){
            echo "Registered successfully";
        }else{
            echo "Registered";
        }
//        $dbServername = "localhost";
//        $dbUsername = "root";
//        $dbPassword = "";
//        $dbName = "travels";
//
//        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
//
//        $userName = $_POST['userName'];
//        $password = $_POST['password'];
//        $email = $_POST['email'];
//
//        $sql = "SELECT UserName FROM traveluser WHERE UserName='$userName'";
//        $result = mysqli_query($conn, $sql);
//        $test = mysqli_fetch_assoc($result);
//        if ($test) {
//            echo "Sorry,The user name already exists!";
//        } else {
//            // 密码哈希加盐
//            $salt = generateSalt();
//            $passwordHash = generateHashPassword($password,$salt);
//            //给用户名赋值UID
//            $sql = "SELECT MAX(UID) FROM traveluser";
//            $result = mysqli_query($conn, $sql);
//            $output = mysqli_fetch_assoc($result);
//            $uID = $output['MAX(UID)'] + 1;
//
//            $sql = "INSERT INTO traveluser(UID,UserName,Password,Salt,Email,State)
//VALUES('$uID','$userName','$passwordHash','$salt','$email','1')";
//
//            if (mysqli_query($conn, $sql)) {
//                echo "Register successfully";
//                //关闭数据库
//                mysqli_close($conn);
//            } else {
//                echo "Failure to register";
//            }
//        }
        ?>
    </h3>
    <?php
    if ($result == 0) {
        echo "<input type='button' value='Back to register' onclick='register()'>";
    }else{
        echo "<input type='button' value='Go to login' onclick='login()'>";
    }

    ?>
</div>
</body>
<script>
    function register() {
        window.location.href = "register.php";
    }

    function login() {
        window.location.href = "login.php";
    }
</script>
</html>

