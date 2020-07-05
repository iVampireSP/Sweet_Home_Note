<?php
session_start();
require_once('config/config.php');
require_once('config/theme.php');
require_once('class/User.class.php');
$user = new User();
$user->db_con = $db_con;
$user->noteid = $_GET['noteid'];
if (!isset($_SESSION['user'])) {
    header("Location: unlock.php");
    return '*';
}
if (!isset($_GET['noteid'])) {
    header("Location: index.php");
    return '*';
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php mduiHead('编辑记事本：' . $user->getTitle()); ?>
</head>
    <?php mduiBody(); mduiHeader('编辑记事本：' . $user->getTitle()); mduiMenu(); ?>
    <form name="editnote" method="post" action="editnote.php?noteid=<?php echo $user->noteid;?>">
        <div class="mdui-textfield mdui-textfield-floating-label">
            <label class="mdui-textfield-label">标题</label>
            <input class="mdui-textfield-input" type="text" name="title" autocomplete="off" value="<?php echo $user->getTitle(); ?>" autofocus required />
        </div>
        <div class="mdui-textfield">
            <textarea class="mdui-textfield-input" rows="10" placeholder="请输入记事本内容" name="content" autocomplete="off"><?php echo $user->viewNote(); ?></textarea>
        </div>
        <div class="mdui-col">
            <button type="submit" class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple">更改记事本</button>
        </div>
    </form>
    <?php
        if (!empty($_POST['title'])||!empty($_POST['content'])) {
            $user->editNote($_POST['title'], $_POST['content']);
            echo '<script>window.location.replace("index.php");</script>';
        }
    ?>
</body>

</html>
