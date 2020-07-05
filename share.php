<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: unlock.php");
}
if (!isset($_REQUEST['noteid'])) {
    header("Location: index.php");
    return '*';
}
require_once('config/config.php');
require_once('class/User.class.php');
$user = new User();
$user->noteid = $_REQUEST['noteid'];
$user->db_con = $db_con;

?>