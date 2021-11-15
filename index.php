<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: unlock.php");
    return '*';
}
require_once('config/config.php');
require_once('config/theme.php');
require_once('class/User.class.php');
$user = new User();
$user->db_con = $db_con;
// $user->addNote('标题', '内容', NULL, $db_con);
?>

<!DOCTYPE html>
<html>

<head>
    <?php mduiHead('记事本'); ?>
    <style type="text/css">
        .texto {
            width: 50%;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
        }
    </style>
</head>
    <?php mduiBody(); mduiHeader('记事本') ; mduiMenu(); ?>
    <ul class="mdui-list mdui-m-b-3">
        <?php
            $user->listNote();
        ?>
    </ul>

</body>

</html>
