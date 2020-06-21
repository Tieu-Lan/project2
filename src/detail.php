<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>details</title>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../layui/css/layui.css" media="all">
    <link rel="stylesheet" href="css/details.css">
    <!--    <link href="css/home.css" rel="stylesheet" type="text/css">-->
    <link href="css/header_footer.css" rel="stylesheet" type="text/css">
    <!--    <link href="css/index.css" rel="stylesheet">-->
    <link href="css/header_footer.css" rel="stylesheet">
</head>
<?php
//  连接数据库
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "travels";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
$imageID = $_GET["id"];
$sql = "SELECT `ImageID`,Title,Description,PATH,UID,CountryCodeISO,CityCode FROM travelimage WHERE ImageID = '$imageID'";

//  图片信息
$result = mysqli_query($conn, $sql);
$output = mysqli_fetch_assoc($result);
$title = $output['Title'];
$description = "";
$cityCode = "";
$city = "";
$uID = $output['UID'];
$path = $output['PATH'];
$countryCodeISO = $output['CountryCodeISO'];
if (!isset($output['Description'])) {
    $description = "The author left no word～";
} else {
    $description = $output['Description'];
}
//获取城市名
if (isset($output['CityCode'])){
    $cityCode = $output['CityCode'];
    $sql = "SELECT AsciiName FROM geocities WHERE GeoNameID = '$cityCode'";
    $result = mysqli_query($conn, $sql);
    $output = mysqli_fetch_assoc($result);
    $city = $output['AsciiName'];
} else{
    $city = "No";
}

//获取用户名
$sql = "SELECT UserName FROM traveluser WHERE UID = '$uID'";
$result = mysqli_query($conn, $sql);
$output = mysqli_fetch_assoc($result);
$userName = $output['UserName'];
// 获取喜欢的人数
$sql = "SELECT count(ImageID) FROM travelimagefavor WHERE ImageID = '$imageID'";
$result = mysqli_query($conn, $sql);
$output = mysqli_fetch_assoc($result);
$favor = $output['count(ImageID)'];
// 获取国家名称
$sql = "SELECT CountryName,Continent FROM geocountries WHERE ISO = '$countryCodeISO'";
$result = mysqli_query($conn, $sql);
$output = mysqli_fetch_assoc($result);
$countryName = $output['CountryName'];
$continentCode = $output['Continent'];
//获取洲名称
$sql = "SELECT ContinentName FROM geocontinents WHERE ContinentCode = 'EU'";
$result = mysqli_query($conn, $sql);
$output = mysqli_fetch_assoc($result);
$continentName = $output['ContinentName'];
//获取登陆ID
?>
<body>
<!--    导航栏-->
<ul class="layui-nav">

    <a href=""><img src="../images/tea.png" class="layui-nav-img"></a>

    <li class="layui-nav-item">
        <a href="../index.php" style="color: black">Home</a>
    </li>
    <li class="layui-nav-item">
        <a href="browse.php" style="color: black">Browse</a>
    </li>
    <li class="layui-nav-item">
        <a href="search.php" style="color: black">Search</a>
    </li>
    <?php
    if (isset($_SESSION['userName'])) {
        echo "<li class=\"layui-nav-item\" lay-unselect=\"\" style=\"float: right\">
        <a href=\"javascript:;\" style=\"color: black;left: 100px\">" . $_SESSION['userName'] . "</a>
        <dl class=\"layui-nav-child\" style='left: -55px;background-color: #cac3b7;border-radius: 10px'>
            <dd><a href=\"upload.php\"><span class=\"glyphicon glyphicon-cloud-upload\" aria-hidden=\"true\"></span> Upload</a></dd>
            <dd><a href=\"my_photos.php\"><span class=\"glyphicon glyphicon-heart\" aria-hidden=\"true\"></span> My Photos</a></dd>
            <dd><a href=\"turn_to_favor.php\"><span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\"></span> My Collection</a></dd>
            <dd><a href=\"logout.php?href=detail.php&id=$imageID\"><span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> Logout</a></dd>
        </dl>";
    } else {
        echo "<li class=\"layui-nav-item\" lay-unselect=\"\" style=\"float: right\">
        <a href=\"login.php?href=detail.php&id=$imageID\" style=\"color: black\"><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span> Login</a></li>";
    }
    ?>
</ul>
<div class="body">
    <div class="head"><p><?php echo $title ?> <small>by <?php echo $userName ?></small></p></div>
    <div class="content">
        <img src="../travel-images/normal/medium/<?php echo $path ?>">
        <div class="information">
            <div class="head">Like Number</div>
            <div><h3><?php echo $favor ?></h3></div>
        </div>
        <div class="information">
            <div class="head">Image Details</div>
            <p class="line">Continent: <?php echo $continentName ?></p>
            <p class="line">Country: <?php echo $countryName ?></p>
            <p>City: <?php echo $city?></p>
        </div>
        <?php
        if (isset($_SESSION['userName'])) {
            $sql = "SELECT UID FROM traveluser WHERE UserName = '" . $_SESSION['userName'] . "'";
            $result = mysqli_query($conn, $sql);
            $output = mysqli_fetch_assoc($result);
            $uID = $output['UID'];
            //判断是否收藏
            $sql = "SELECT * FROM `travelimagefavor` WHERE UID = '$uID' AND ImageID = '$imageID'";
            $result = mysqli_query($conn, $sql);
            $output = mysqli_fetch_assoc($result);
            //关闭数据库
            mysqli_close($conn);
            if ($output) {
                echo "<button type='button' onclick=\"window.location.href = 'cancel_favor.php?href=detail.php&id=$imageID'\">取消收藏</button>";
            } else {
                echo "<button type=\"button\" onclick=\"window.location.href = 'add_to_my_photos.php?id=$imageID'\">收藏</button>";
            }
        } else {
            echo "<button type='button' disabled='disabled'>登陆可收藏</button>";
        }
        ?>
        <p>
            <?php echo $description ?>
        </p>
    </div>
</div>
<footer>
    <ul class="foot1">
        <li><a href="#">使用条款</a></li>
        <li><a href="#">关于</a></li>
        <li><a href="#">隐私保护</a></li>
        <li><a href="#">联系我们</a></li>
        <li><a href="#">Cookie</a></li>
        <li><a href="#">投诉</a></li>
    </ul>
    <ul class="foot2">
        <li><a href="#"><img src="../images/WeChat.png"></a></li>
        <li><a href="#"><img src="../images/QQ.png"></a></li>
        <li><a href="#"><img src="../images/xinlang.png"></a></li>
        <li><a href="#"><img src="../images/location.png"></a></li>
    </ul>
    <small>Copyright Ⓒ 2019- 2021 Web 19SS. All Rights Reserved. 备案号: 19302010053</small>
</footer>
</body>
<script src="../layui/layui.js"></script>
<script src="js/header.js"></script>
</html>