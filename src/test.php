<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "travels";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$sql = "SELECT MAX(UID) FROM traveluser";
$result = mysqli_query($conn, $sql);
$test = mysqli_fetch_assoc($result);

$max = $test['MAX(UID)'] + 1;
echo $max;
?>