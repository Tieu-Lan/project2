<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Favor</title>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../layui/css/layui.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/information-box.css">
    <link rel="stylesheet" type="text/css" href="css/browse.css">
    <link rel="stylesheet" type="text/css" href="css/header_footer.css">
</head>
<body>
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
            <dd><a href=\"my_photos.php;\"><span class=\"glyphicon glyphicon-heart\" aria-hidden=\"true\"></span> My Photos</a></dd>
            <dd><a href=\"turn_to_favor.php\"><span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\"></span> My Collection</a></dd>
            <dd><a href=\"logout.php?href=../index.php\"><span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> Logout</a></dd>
        </dl>";
    } else {
        echo "<li class=\"layui-nav-item\" lay-unselect=\"\" style=\"float: right\">
        <a href=\"login.php?href=my_photo.php\" style=\"color: black\"><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span> Login</a></li>";
    }
    ?>
</ul>
<div class="body">
    <p class="head">My Favorite</p>
    <?php
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "travels";
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    //用户UID
    $uID = $_SESSION['UID'];
    //读取favor
    $sql = "SELECT ImageID FROM travelimagefavor WHERE UID = '$uID'";
    $result = mysqli_query($conn, $sql);
    $output = mysqli_fetch_all($result);
    $count = count($output);
    //获取总数
    $limit = 6;
    $page = 1;
    if (isset($_GET['limit']) && isset($_GET['page'])){
        $limit = $_GET['limit'];
        $page = $_GET['page'];
    }

    if ($count - 6 * ($page - 1) < 6) {
        $limit = $count - 6 * ($page - 1);
    }
    for ($i = 6 * ($page - 1); $i < $limit + 6 * ($page - 1) ; $i++) {
        $imageID = $output[$i][0];
        $sql = "SELECT Title,Description,PATH FROM travelimage WHERE ImageID = '$imageID'";
        $result1 = mysqli_query($conn, $sql);
        $output1 = mysqli_fetch_assoc($result1);
        $title = $output1['Title'];
        $path = $output1['PATH'];
        $description = "";
        if (!isset($output1['Description'])) {
            $description = "The author left no word～";
        } else {
            $description = $output1['Description'];
        }
        $bottom = "";
        if ($i + 1 == $limit + 6 * ($page - 1) )
            $bottom = " id=\"clear-border\"";
        echo "<div class=\"content\"$bottom>
        <a href=\"detail.php?id=$imageID\"><img src=\"../travel-images/normal/medium/" . $path . "\"></a>
        <div class=\"information\">
            <a href=\"detail.php?id=$imageID\"><h2>" . $title . "</h2></a>
            <p>" . $description . "</p>
            <button type=\"button\" onclick=\"window.location.href = 'cancel_favor.php?href=turn_to_favor.php&id=$imageID'\">Delete</button>
        </div>
    </div>";
    }
    ?>
    <div id="demo"></div>
</div>
<!--刷新and回到顶部-->
<div class="side">
    <ul>
        <li><a id="return_top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a></li>
        <li><a href="favor.php"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a></li>
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
<script src="js/side_button.js"></script>
<script>
    layui.use(['laypage', 'layer'], function () {
        var laypage = layui.laypage, layer = layui.layer;
        laypage.render({
            elem: 'demo'
            , count: <?php echo $count?>
            , limit: 6
            , groups: 5
            , curr: <?php echo $page?>
            , theme: '#904e20'
            , jump: function (obj, first) {
                //obj包含了当前分页的所有参数，比如：
                console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
                console.log(obj.limit); //得到每页显示的条数

                //首次不执行
                if (!first) {
                    //do something
                    window.location.href = "favor.php?page=" + obj.curr + "&limit=" + obj.limit;
                }
            }
        });

    });
</script>
</html>
