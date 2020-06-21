<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>

    <link href="src/css/header_footer.css" rel="stylesheet">
    <link rel="stylesheet" href="layui/css/layui.css" media="all">
    <link href="src/css/home.css" rel="stylesheet" type="text/css">
    <link href="src/css/index.css" rel="stylesheet">
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/css/header_footer.css" rel="stylesheet" type="text/css">
    <style>

    </style>
</head>
<body>
<ul class="layui-nav">

    <a href=""><img src="images/tea.png" class="layui-nav-img"></a>

    <li class="layui-nav-item layui-this">
        <a href="index.php" style="color: black">Home</a>
    </li>
    <li class="layui-nav-item">
        <a href="src/browse.php" style="color: black">Browse</a>
    </li>
    <li class="layui-nav-item">
        <a href="src/search.php" style="color: black">Search</a>
    </li>
    <?php
    if (isset($_SESSION['userName'])) {
        echo "<li class=\"layui-nav-item\" lay-unselect=\"\" style=\"float: right\">
        <a href=\"javascript:;\" style=\"color: black;left: 100px\">" . $_SESSION['userName'] . "</a>
        <dl class=\"layui-nav-child\" style='left: -55px;background-color: #cac3b7;border-radius: 10px'>
            <dd><a href=\"src/upload.php\"><span class=\"glyphicon glyphicon-cloud-upload\" aria-hidden=\"true\"></span> Upload</a></dd>
            <dd><a href=\"src/my_photos.php\"><span class=\"glyphicon glyphicon-heart\" aria-hidden=\"true\"></span> My Photos</a></dd>
            <dd><a href=\"src/turn_to_favor.php\"><span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\"></span> My Collection</a></dd>
            <dd><a href=\"src/logout.php?href=../index.php\"><span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> Logout</a></dd>
        </dl>";
    } else {
        echo "<li class=\"layui-nav-item\" lay-unselect=\"\" style=\"float: right\">
        <a href=\"src/login.php?href=../index.php\" style=\"color: black\"><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span> Login</a></li>";
    }
    ?>
</ul>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" style="border-radius: 5px;background-color: white">
        <div class="item active" style="border-radius: 5px;background-color: white">
            <img src="travel-images/normal/medium/5855774224.jpg" alt="...">
            <div class="carousel-caption ">
            </div>
        </div>
        <div class="item">
            <img src="travel-images/normal/medium/5856616479.jpg" alt="...">
            <div class="carousel-caption">
            </div>
        </div>
        <div class="item">
            <img src="travel-images/normal/medium/5856654945.jpg" alt="...">
            <div class="carousel-caption">
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"
       style="border-radius: 5px">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" style="border-radius: 5px">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="body">
    <div class="content">
        <ul>
            <?php
            //连接数据库
            $dbServername = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "travels";
            $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
            $refresh = isset($_GET["id"]);
            if ($refresh) {
                $sql = "SELECT count(*) FROM travelimage";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_row($result);
                $rowcount = $rows[0];

                $tmp = range(1, 30);
                shuffle($tmp);
                $rand = array_slice($tmp, 0, 6);

                $description = "";

                for ($i = 0; $i < 6; $i++) {
                    $sql1 = "SELECT `ImageID`,Title,Description,PATH FROM travelimage WHERE ImageID = '$rand[$i]'";
                    $result1 = mysqli_query($conn, $sql1);
                    $output1 = mysqli_fetch_assoc($result1);
                    $imageID = $output1['ImageID'];

                    if ($output1['Description'] == "") {
                        $description = "  ";
                    } else {
                        $description = $output1['Description'];
                    }
                    echo "<div class=\"col-md-4\">
        <div class=\"thumbnail\">
            <a href=\"src/detail.php?id=" . $output1['ImageID'] . "\"><img src=\"travel-images/normal/medium/" . $output1['PATH'] . "\"></a>
            <div class=\"caption\">
                <h3 style='overflow: hidden;text-overflow: ellipsis;white-space: nowrap'>" . $output1['Title'] . "</h3>
                <p >" . $description . "</p>
            </div>
        </div>
    </div>";
                }
            } else {
                $sql = "select ImageID,count(1) as number from travelimagefavor GROUP BY ImageID ORDER BY count(1) DESC";

                $result = mysqli_query($conn, $sql);
                $output = mysqli_fetch_all($result);

                $len = count($output);
                if ($len < 6) {
                    $n = 6 - $len;
                    for ($i = 0; $i < $n; $i++) {
                        $output[4 + $i][0] = 3 + $i;
                    }
                }


                if ($output) {
                    for ($i = 0; $i < 6; $i++) {
                        $imageID = $output[$i][0];
                        $sql1 = "SELECT `ImageID`,Title,Description,PATH FROM travelimage WHERE ImageID = '$imageID'";
                        $result1 = mysqli_query($conn, $sql1);
                        $output1 = mysqli_fetch_assoc($result1);
                        $description = "";
                        if ($output1['Description'] == null) {
                            $description = "  ";
                        } else {
                            $description = $output1['Description'];
                        }
//                    echo " <li class=\"im\">
//                <a href=\"\" style='overflow: hidden;height: 30%'><img src=\"travel-images/normal/medium/" . $output1['PATH'] . "\"></a>
//                <a href=\"details.html\"><h3 class=\"title\">" . $output1['Title'] . "</h3></a>
//                <a href=\"details.html\"><h6 class=\"introduce\" style='overflow: hidden;text-overflow: ellipsis;white-space: nowrap'>" . "abczxZXZXzXzXzxZX" . $output1['Description'] . "</h6>
//                </a></li>";
                        echo "<div class=\"col-md-4\">
        <div class=\"thumbnail\">
            <a href=\"src/detail.php?id=$imageID\"><img src=\"travel-images/normal/medium/" . $output1['PATH'] . "\"></a>
            <div class=\"caption\">
                <h3 style='overflow: hidden;text-overflow: ellipsis;white-space: nowrap'>" . $output1['Title'] . "</h3>
                <p >" . $description . "</p>
            </div>
        </div>
    </div>";
                    }
                }
            }
            //关闭数据库
            mysqli_close($conn);
            ?>
        </ul>
    </div>
</div>
<!--返回顶部and刷新页面-->
<div class="side">
    <ul>
        <li><a id="return_top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a></li>
        <li><a href="index.php?id=value"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a></li>
    </ul>
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
        <li><a href="#"><img src="images/WeChat.png"></a></li>
        <li><a href="#"><img src="images/QQ.png"></a></li>
        <li><a href="#"><img src="images/xinlang.png"></a></li>
        <li><a href="#"><img src="images/location.png"></a></li>
    </ul>
    <small>Copyright Ⓒ 2019- 2021 Web 19SS. All Rights Reserved. 备案号: 19302010053</small>
</footer>
</body>
<script src="layui/layui.js" charset="utf-8"></script>
<script src="src/js/header.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="src/js/side_button.js"></script>
</html>