<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}
require_once('config/config.php');
require_once('config/theme.php');
require_once('class/User.class.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php mduiHead('解锁'); ?>
</head>

    <?php mduiBody(); mduiHeader('解锁') ; mduiMenu(); ?>
    <form name="unlock" method="post" action="unlock.php">
        <div class="mdui-textfield mdui-textfield-floating-label">
            <input autocomplete="off" style="text-align: center" class="mdui-textfield-input" type="password" name="password" placeholder="要解锁，请插入密钥并触摸" autofocus required />
        </div>
        <input name="Submit" type="submit" style="display: none;" value="解锁" />
    </form>
    <?php
    if(isset($_REQUEST['password'])) {
        // 用户登录
        $user = new User();
        echo $user->userLogin($_REQUEST['password'], PASSWORD);
    }
?>
</body>

</html>
