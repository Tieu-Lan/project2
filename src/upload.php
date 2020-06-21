<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../layui/css/layui.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/header_footer.css">
    <link rel="stylesheet" type="text/css" href="css/search-box.css">
    <link rel="stylesheet" type="text/css" href="css/information-box.css">
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
            <dd><a href=\"logout.php?href=../search.php\"><span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> Logout</a></dd>
        </dl>";
    } else {
        echo "<li class=\"layui-nav-item\" lay-unselect=\"\" style=\"float: right\">
        <a href=\"login.php?href=my_photo.php\" style=\"color: black\"><span class='glyphicon glyphicon-log-in' aria-hidden='true'></span> Login</a></li>";
    }
    ?>
</ul>
<div class="body">
    <p class="head">Upload</p>
    <form method="post" action="">
        <div id="image-review-box">
            <div id="test-image-preview"></div>
            <div id="upload">
                <input type="file" id="test-image-file" name="test">
                <div id="show-box">选择图片</div>
            </div>
            <p id="test-file-info"></p>
        </div>
        <div id="upload-box">
            <p class="border-margin">图片标题：</p>
            <input type="text" class="border-margin">
            <p class="border-margin">图片描述：</p>
            <textarea class="border-margin"></textarea>
            <p class="border-margin">拍摄国家：</p>
            <input type="text" class="border-margin">
            <p class="border-margin">拍摄城市：</p>
            <input type="text" class="border-margin">
            <br>
            <input type="submit" onclick="alert('上传成功')">
        </div>
    </form>
</div>
<div class="side">
    <ul>
        <li><a href="#"><img src="../images/up.png"></a></li>
        <li><a href="#" onclick="alert('已刷新')"><img src="../images/shuaxin.png"></a></li>
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
<script src="js/upload.js"></script>
<script src="../layui/layui.js"></script>
<script src="js/header.js"></script>
<script src="js/side_button.js"></script>
</html>
