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
<?php mduiBody();
mduiHeader('编辑记事本：' . $user->getTitle());
mduiMenu(); ?>
<form name="editnote" method="post" action="editnote.php?noteid=<?php echo $user->noteid; ?>">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">标题</label>
        <input class="mdui-textfield-input" type="text" name="title" autocomplete="off" value="<?php echo $user->getTitle(); ?>" autofocus required />
    </div>
    <div class="mdui-textfield">
    </div>
    <div class="mdui-textfield">
        <div id="editor">
            <textarea name="content" id="content" style="display:none;"><?php echo $user->viewNote(); ?></textarea>
        </div>
    </div>
    <div class="mdui-col mdui-m-b-5">
        <button type="submit" class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple">更改记事本</button>
    </div>
</form>
<script src="https://cdn.bootcdn.net/ajax/libs/editor-md/1.5.0/editormd.js"></script>
<script type="text/javascript">
    $(function() {
        var editor = editormd("editor", {
            width: "100%",
            height: 750,
            emoji: true,
            path: 'editor.md/lib/',
            imageUpload: false,
        });
    });
</script>
<?php
if (!empty($_POST['title']) || !empty($_POST['content'])) {
    $user->editNote($_POST['title'], $_POST['content']);
    echo '<script>window.location.replace("note.php?noteid=' . $user->noteid . '");</script>';
}
?>
</body>

</html>