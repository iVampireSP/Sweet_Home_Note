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
    <?php mduiHead('新增记事本'); ?>
</head>
<?php mduiBody();
mduiHeader('新增记事本');
mduiMenu(); ?>
<form name="addnote" method="post" action="addnote.php">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">标题</label>
        <input class="mdui-textfield-input" type="text" name="title" value="<?php echo date('Y-m-d H:i:s') ?>" autocomplete="off"  required />
    </div>
    <div class="mdui-textfield">
        <label class="mdui-textfield-label">内容</label>
        <div id="editor">
            <textarea name="content" id="content" style="display:none;">
## 美好的一天从记录开始。</textarea>
        </div>
    </div>
    <div class="mdui-col mdui-m-b-5">
        <button type="submit" class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple">新增记事本</button>
    </div>
</form>
<script src="https://cdn.bootcdn.net/ajax/libs/editor-md/1.5.0/editormd.js"></script>
<script type="text/javascript">
    $(function() {
        var editor = editormd("editor", {
            width: "100%",
            height: 750,
            markdown: "",
            emoji: true,
            path: 'editor.md/lib/',
            imageUpload: false,
        });
    });
</script>
<?php
if (!empty($_REQUEST['title']) || !empty($_REQUEST['content'])) {
    $user->addNote($_REQUEST['title'], $_REQUEST['content']);
    echo '<script>window.location.replace("index.php");</script>';
}
?>
</body>

</html>