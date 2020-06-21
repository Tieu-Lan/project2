<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="body">
    <h3 class="t">
        <?php
        $userName = $_SESSION['userName'];
        //连接数据库
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "travels";
        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
        //获取imageID
        $imageID = $_GET['id'];
        //赋值FavorID;
        $sql = "SELECT MAX(FavorID) FROM travelimagefavor";
        $result = mysqli_query($conn, $sql);
        $output = mysqli_fetch_assoc($result);
        $favorID = $output['MAX(FavorID)'] + 1;
        //获取UID
        $sql = "SELECT UID FROM traveluser WHERE UserName = '" . $userName . "'";
        $result = mysqli_query($conn, $sql);
        $output = mysqli_fetch_assoc($result);
        $uID = $output['UID'];
        //插入数据库
        $sql = "INSERT INTO travelimagefavor(UID,ImageID)
VALUES('$uID','$imageID')";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if ($result) {
            header("location:detail.php?id=$imageID");
            exit();
        } else {
            echo "收藏失败";
        }
        ?>
    </h3>
    <?php
    if (!$result) {
        echo "<input type='button' value='Back' onclick='detail()'>";
    }

    ?>
</div>
</body>
<script>
    function detail() {
        window.location.href = "detail.php?id=<?php echo $imageID?>";
    }
</script>
</html>



