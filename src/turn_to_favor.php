<?php
session_start();
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
mysqli_close($conn);
//获取总数
$count = count($output);
$limit = 6;
if ($count < 6) {
    $limit = $count;
}
header("location:favor.php?page=1&limit=$limit");
