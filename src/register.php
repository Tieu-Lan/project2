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
    <?php
    $canUse = true;
    $passwordError = $nameError = $userName = $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "travels";

        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $sql = "SELECT UserName FROM traveluser WHERE UserName='$userName'";
        $result = mysqli_query($conn, $sql);
        $test = mysqli_fetch_assoc($result);
        if ($test){
            $nameError = "Sorry,The user name already exists!";
        }else{
            // 密码哈希加盐
            $salt = generateSalt();
            $passwordHash = generateHashPassword($password,$salt);
            // 存入数据库
            $sql = "INSERT INTO traveluser(UserName,Password,Salt,Email,State)
VALUES($userName','$passwordHash','$salt','$email','1')";
            if (mysqli_query($conn, $sql)) {
                header("location:register_result.php?result=1");
                //关闭数据库
                mysqli_close($conn);
            } else {
                header("location:register_result.php?result=0");
                mysqli_close($conn);
            }
        }
    }
    ?>
</head>
<body>
<div class="body">
    <h1 class="t">Register</h1>
    <form class="text" name="register">
        <h3 class="t">Username:</h3>
        <h4 style="display: block"><?php echo $nameError?></h4>
        <h4 id="name">* Please enter your name !</h4>
        <input type="text" class="textbox" name="userName" maxlength="10">
        <h3 class="t">E-mail:</h3>
        <h4 id="email">* Please enter your E-mail !</h4>
        <h4 id="emailError">* Please enter the address in the correct format !</h4>
        <input type="email" class="textbox" name="email" maxlength="50">
        <h3 class="t">Password:</h3>
        <h4 id="password">* Please enter your password !</h4>
        <h4 id="passwordError">* The password length is between 6 and 20 !</h4>
        <input type="password" class="textbox" name="password"maxlength="20">
        <h3 class="t">Confirm Your Password:</h3>
        <h4 id="again">* Please enter your password again !</h4>
        <h4 id="difference">* Please enter the same password !</h4>
        <input type="password" class="textbox" name="again" maxlength="20">
        <input type="button" value="Sigh Up" onclick="check()">
    </form>
</div>
<div class="logo"><img src="../images/tea.png"></div>
<div class="foot"><small>Copyright Ⓒ 2019- 2021 Web 19SS. All Rights Reserved. 备案号: 19302010053</small></div>
</body>
<script src="js/register.js"></script>
</html>