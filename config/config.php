<?php
// error_reporting(0);
// 数据库连接配置
define('DB_HOST', 'localhost');
define('DB_USER', 'sweet_home');
define('DB_PASS', 'B6wMcmN7EKYb7*PS');
define('DB_NAME', 'sweet_home');
$db_con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$db_con->query("set names utf8");

// 判断数据库是否连接正常
if ($db_con->connect_error) {
    die('数据库连接失败：' . $db_con->connect_error);
}

/* 站点配置 */
// 名称
define('SITENAME', 'iVampireSP Sweet Home');

// 账户密码（需要md5）
define('PASSWORD', 'c4ca4238a0b923820dcc509a6f75849b');