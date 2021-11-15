<?php
session_start();
require_once('config/config.php');
require_once('class/User.class.php');
$user = new User();
$user->noteid = $_REQUEST['noteid'];
$user->db_con = $db_con;
if (!isset($_SESSION['user'])) {
    // 判断是否被共享
    if ($user->getShare() == NULL) {
        header("Location: unlock.php");
        return '*';
    }
}
if (!isset($_REQUEST['noteid'])) {
    header("Location: index.php");
    return '*';
}

require_once('config/theme.php');

if (!empty($_REQUEST['action'])) {
    // 判断是否登录
    if (!isset($_SESSION['user'])) {
        echo '您没有权限。';
        return '*';
    } else {
        echo $user->shareNote();
        return '*';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php mduiHead('浏览：' . $user->getTitle()); ?>
    <style type="text/css">
        img {
            width: 99.5%;
        }
    </style>
</head>
<?php mduiBody();
mduiHeader('浏览：' . $user->getTitle());
mduiMenu(); ?>
<script src="ajax.js"></script>
<div class="mdui-typo-display-1 mdui-m-t-2 mdui-text-center"><?php echo $user->getTitle(); ?></div>
<div id="markdown-view">
    <textarea style="display:none;"><?php echo $user->viewNote(); ?></textarea>
</div>
<button class="mdui-fab mdui-fab-fixed mdui-color-theme-accent mdui-ripple" onclick="sharenote(<?php echo $_REQUEST['noteid']; ?>)"><i class="mdui-icon material-icons">share</i></button>
<script type="text/javascript">
    $(function() {
        var View = editormd.markdownToHTML("markdown-view", {});
    });
</script>
<div class="mdui-m-b-3"></div>
</body>

</html>