<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: unlock.php");
    return '*';
}
if (!isset($_GET['noteid'])) {
    header("Location: index.php");
    return '*';
}
require_once('config/config.php');
require_once('config/theme.php');
require_once('class/User.class.php');
$user = new User();
$user->db_con = $db_con;
$user->noteid = $_GET['noteid'];
$user->delNote();
echo '<script>window.location.replace("index.php");</script>';
?>