<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<div class="body">
    <h1 class="t">Login</h1>
    <h4 style="display: block"><?php
        $canUse = true;
        $passwordError = $nameError = $userName = $password = "";
        $passwordHash = "";
        $href = $_GET['href'];
        $imageID = "";
        if (isset($_GET['id'])){
            $imageID = $_GET['id'];
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['userName'])) {
                $userName = $_POST['userName'];
            } else {
                $canUse = false;
                $nameError = "* Please enter the user name";
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['password'])) {
                $password = $_POST['password'];
            } else {
                $canUse = false;
                $passwordError = "* Please enter the password";
            }
        }
        if ($canUse && $_SERVER["REQUEST_METHOD"] == "POST") {
            $dbServername = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "travels";

            $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

            $sql = "SELECT UserName ,UID FROM traveluser WHERE UserName = '$userName'";
            $result = mysqli_query($conn, $sql);
            $test = mysqli_fetch_assoc($result);
            if ($test) {
                $uID = $test['UID'];
                $sql = "SELECT Password,Salt FROM traveluser WHERE (UserName = '$userName')";
                $result = mysqli_query($conn, $sql);
                $test = mysqli_fetch_assoc($result);
                $salt = $test['Salt'];
                $passwordHash = md5(sha1($password) . $salt);
                if ($passwordHash == $test['Password']) {
                    //登陆成功跳转网页
                    $_SESSION['userName'] = $userName;
                    $_SESSION['UID'] = $uID;
                    header("Location: $href?id=$imageID");
                    exit;
                } else {
                    $passwordError = "* 密码错误";
                }
            } else {
                $nameError = "* 用户名不存在";
            }
        }
        ?></h4>
    <form class="text" action="login.php?href=<?php echo $href?>&id=<?php echo $imageID?>" method="post">
        <h3 class="t">Username/E-mail:</h3>
        <h4 style="display: block">
            <?php
            echo $nameError;
            ?>
        </h4>
        <input type="text" class="textbox" name="userName">
        <h3 class="t">Password:</h3>
        <h4 style="display: block">
            <?php
            echo $passwordError;
            ?>
        </h4>
        <input type="password" class="textbox" name="password"><br>
        <input type="submit" class="button" value="Login">
    </form>
</div>
<div class="small"><small>New to IG? <a href="register.php">Create a new account?</a></small></div>
<div class="logo">
    <img src="../images/tea.png">
</div>
<div class="foot"><small>Copyright Ⓒ 2019- 2021 Web 19SS. All Rights Reserved. 备案号: 19302010053</small></div>
<body>
</body>
</html>