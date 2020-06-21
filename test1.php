<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "travels";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
//选取洲
$sql = "SELECT ContinentCode,ContinentName FROM geocontinents";
$result = mysqli_query($conn, $sql);
$continents = mysqli_fetch_all($result);
print_r($continents);