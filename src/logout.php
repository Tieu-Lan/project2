<?php
session_start();
session_unset();
session_destroy();
$id = "";
if (isset($_GET['id']))
    $id = $_GET['id'];
header("location:" . $_GET['href'] ."?" . "id=" . $_GET['id']);
?>
