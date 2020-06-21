<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../layui/css/layui.css" media="all">
    <link rel="stylesheet" href="css/search-box.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/information-box.css">
    <link rel="stylesheet" href="css/header_footer.css" type="text/css">
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
    <li class="layui-nav-item layui-this">
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
<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
}
?>
<div class="body">
    <p class="head">Search</p>
    <form method="post" action="#">
        <div><input name="select" type="radio">Filter by Tittle</div>
        <input type="text">
        <div><input name="select" type="radio">Filter by Description</div>
        <textarea></textarea><br>
        <input type="submit" value="Search" onclick="alert('搜索成功')">
    </form>
</div>
<div class="body">
    <p class="head">Result</p>
    <div class="content">
        <a href="details.html"><img src="../travel-images/normal/medium/6592294487.jpg"></a>
        <div class="information">
            <a href="details.html"><h2>Title</h2></a>
            <p>
                Welcome to the Fundamentals of Web Development. This textbook is intended
                to cover the broad range of topics required for modern web development
                and is suitable for intermediate to upper-levelcomputing students.
                A significant percent- age of the material in this book has also been used
                by the authors to teach web development principles to first-year computing students
                and to non-computing students as well.
            </p>
        </div>
    </div>
    <div class="content">
        <a href="details.html"><img src="../travel-images/normal/medium/6592294487.jpg"></a>
        <div class="information">
            <a href="details.html"><h2>Title</h2></a>
            <p>
                Welcome to the Fundamentals of Web Development. This textbook is intended
                to cover the broad range of topics required for modern web development
                and is suitable for intermediate to upper-levelcomputing students.
                A significant percent- age of the material in this book has also been used
                by the authors to teach web development principles to first-year computing students
                and to non-computing students as well.
            </p>
        </div>
    </div>
    <div class="content">
        <a href="details.html"><img src="../travel-images/normal/medium/6592294487.jpg"></a>
        <div class="information">
            <a href="details.html"><h2>Title</h2></a>
            <p>
                Welcome to the Fundamentals of Web Development. This textbook is intended
                to cover the broad range of topics required for modern web development
                and is suitable for intermediate to upper-levelcomputing students.
                A significant percent- age of the material in this book has also been used
                by the authors to teach web development principles to first-year computing students
                and to non-computing students as well.
            </p>
        </div>
    </div>
    <div class="content" id="clear-border">
        <a href="details.html"><img src="../travel-images/normal/medium/6592294487.jpg"></a>
        <div class="information">
            <a href="details.html"><h2>Title</h2></a>
            <p>
                Welcome to the Fundamentals of Web Development. This textbook is intended
                to cover the broad range of topics required for modern web development
                and is suitable for intermediate to upper-levelcomputing students.
                A significant percent- age of the material in this book has also been used
                by the authors to teach web development principles to first-year computing students
                and to non-computing students as well.
            </p>
        </div>
    </div>
</div>
<div class="side">
    <ul>
        <li><a id="return_top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a></li>
        <li><a href="search.php"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a></li>
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
</html>
