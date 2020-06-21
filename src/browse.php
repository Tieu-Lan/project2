<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse</title>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../layui/css/layui.css" media="all">
    <link rel="stylesheet" href="css/browse.css" type="text/css">
    <link href="css/header_footer.css" rel="stylesheet" type="text/css">
</head>
<body>
<ul class="layui-nav">

    <a href=""><img src="../images/tea.png" class="layui-nav-img"></a>

    <li class="layui-nav-item">
        <a href="../index.php" style="color: black">Home</a>
    </li>
    <li class="layui-nav-item layui-this">
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
    <form class="hot-box" action="#" method="get">
        <div class="hot">
            <p class="head">Search by Title</p>
            <div class="bottom">
                <span><input type="text" style="width: 80%"></span>
                <span><a href="#" onclick="alert('搜索成功')"><span class="glyphicon glyphicon-search"
                                                                aria-hidden="true"></span></a></span>
            </div>
        </div>
        <div class="hot">
            <ul>
                <li class="head"><a href="#" style="">Hot City</a></li>
                <li class="em"><a href="#">Shanghai</a></li>
                <li class="em"><a href="#">Beijing</a></li>
                <li class="em"><a href="#">Guangzhou</a></li>
                <li class="bottom emm"><a href="#">New York</a></li>
            </ul>
        </div>
        <div class="hot">
            <ul>
                <li class="head"><a href="#">Hot Country</a></li>
                <li class="em"><a href="#">China</a></li>
                <li class="em"><a href="#">America</a></li>
                <li class="em"><a href="#">Canada</a></li>
                <li class="bottom emm"><a href="#">Japan</a></li>
            </ul>
        </div>
        <div class="hot">
            <ul>
                <li class="head"><a href="#">Hot Content</a></li>
                <li class="em"><a href="#">Animal</a></li>
                <li class="em"><a href="#">Building</a></li>
                <li class="bottom emm"><a href="#">River</a></li>
            </ul>
        </div>
    </form>
    <div class="filter-box">
        <div class="filter-box-head"><p>Filter</p></div>
        <div class="filter-box-select">
            <form>
            <span>
                <select id="s1" onchange="s12()">
                    <option>Filter by Continent</option>
                    <?php
                    //连接数据库
                    $dbServername = "localhost";
                    $dbUsername = "root";
                    $dbPassword = "";
                    $dbName = "travels";
                    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
                    //选取洲
                    $sql = "SELECT ContinentCode,ContinentName FROM geocontinents";
                    $result = mysqli_query($conn, $sql);
                    $continents = mysqli_fetch_all($result);
                    $count_continents = count($continents);
                    for ($i = 0; $i < $count_continents; $i++) {
                        $continentName = $continents[$i][1];
                        $continentCode = $continents[$i][0];
                        echo "<option value='$continentCode'>" . $continents[$i][1] . "</option>";
                    }
                    ?>
                </select>
            </span>
                <span>
                <select id="s2" onchange="s23()">
                    <option value="none">Filter by Country</option>
                </select>
            </span>
                <span>
                <select id="s3">
                    <?php
                    if (isset($_GET['country']) && isset($_GET['continent'])) {
                        $countryName = $_GET['country'];
                        $continentName = $_GET['continent'];
                        $sql = "SELECT ISO FROM geocountries WHERE CountryName = '$countryName'";
                        $result = mysqli_query($conn, $sql);
                        $output = mysqli_fetch_assoc($result);
                        $countryISO = $output['ISO'];
                        $sql = "SELECT AsciiName FROM geocities WHERE CountryCodeISO = '$countryISO'";
                        $result = mysqli_query($conn, $sql);
                        $cities = mysqli_fetch_all($result);
                        $count_cities = count($cities);
                        for ($x = 0; $x < $count_cities; $x++) {
                            $cityName = $cities[$x][0];
                            echo "<option>" . $cityName . "</option>";
                        }
                        echo "<script>
        let s1 = document.getElementById(\"s1\");
        for (let i = 0; s1.options.length; i++) {
            if (s1.options[i].value == continent) {
                s1.options[i].selected = true;
                break
            }
        }
        s12();
    </script>";
                    } else {
                        echo "<option>Filter by City</option>";
                    }
                    ?>
                </select>
                </span>
                <span>
                <input type="submit" value="Filter" onclick="alert('过滤成功')">
            </span>
            </form>
            <ul>
                <?php
//                $sql = "SELECT ImageID,PATH FROM travelimage";
//                $result = mysqli_query($conn,$sql);
//                $output = mysqli_fetch_all($result);
//                $count = count($output);
//                for ($i = 0;$i < $count; $i ++){
//                    $path = $output[$i][1];
//                    $imageID = $output[$i][0];
//                    echo "<li><a href=\"detail.php?id=$imageID\"><img src=\"../travel-images/normal/medium/$path\"></a></li>";
//                }
                $sql = "SELECT ImageID,PATH FROM travelimage";
                $result = mysqli_query($conn,$sql);
                $output = mysqli_fetch_all($result);
                $count = count($output);
                $limit = 12;
                $page = 1;
                if (isset($_GET['limit']) && isset($_GET['page'])){
                    $limit = $_GET['limit'];
                    $page = $_GET['page'];
                }

                if ($count - 12 * ($page - 1) < 12) {
                    $limit = $count - 12 * ($page - 1) - 1;
                }
                for ($i = 12 * ($page - 1);$i < $limit + 12 * ($page - 1); $i++){
                    $path = $output[$i][1];
                    $imageID = $output[$i][0];
                    echo "<li><a href=\"detail.php?id=$imageID\"><img src=\"../travel-images/normal/medium/$path\"></a></li>";
                }
                ?>
            </ul>
            <div id="demo"></div>
        </div>
    </div>
</div>
<!--刷新and回到顶部-->
<div class="side">
    <ul>
        <li><a id="return_top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a></li>
        <li><a href="browse.php"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span></a></li>
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
    function s12() {
        let s1 = document.getElementById("s1");
        let s2 = document.getElementById("s2");
        let add;

        if (s1.value === "none") {
            add = new Array("Filter by Country");
        }
        <?php
            for ($i = 0; $i < $count_continents; $i++) {
                $continentCode = $continents[$i][0];
                echo "else if (s1.value === \"$continentCode\") {
            add = new Array(";
                $sql = "SELECT CountryName,ISO FROM geocountries WHERE Continent = '$continentCode'";
                $result = mysqli_query($conn, $sql);
                $countries = mysqli_fetch_all($result);
                $count_countries = count($countries);
                for ($j = 0; $j < $count_countries; $j++) {
                    $countryName = $countries[$j][0];
                    echo "'$countryName',";
                }
                echo ");}";
            }
            ?>
        else {
            add = null;
        }
        s2.length = 0;
        for (let i = 0; add.length; i++) {
            let s = new Option();
            s.text = add[i].split()[0];
            s.value = add[i].split()[0];
            s2.add(s);
        }
    }

    function s23() {
        let s1 = document.getElementById("s1");
        let s2 = document.getElementById("s2");
        let country = s2.value;
        let continent = s1.value;
        location.href = "?country=" + country + "&continent=" + continent;
        console.log(country)
    }


</script>
<script>
    layui.use(['laypage', 'layer'], function () {
        var laypage = layui.laypage, layer = layui.layer;
        laypage.render({
            elem: 'demo'
            , count: <?php echo $count?>
            , limit: 12
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
                    window.location.href = "browse.php?page=" + obj.curr + "&limit=" + obj.limit;
                }
            }
        });

    });
</script>
</html>
