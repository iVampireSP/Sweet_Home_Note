<?php
function mduiHeader($subtitle)
{
    $sitename = SITENAME;
    echo <<<EOF
    <header class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-theme">
        <span style="border-radius: 100%" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white"
            mdui-drawer="{target: '#main-drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
        <a href="index.php" class="mdui-typo-headline mdui-hidden-xs">$sitename</a>
        <a href="#" class="mdui-typo-title">$subtitle</a>
    </div>
</header>
EOF;
}
function mduiMenu()
{
    $username = $_SESSION['user'] ?? 0;

    if (isset($_REQUEST['noteid'])) {
        $noteid = $_REQUEST['noteid'];
        $editnote = "<a href=\"editnote.php?noteid=$noteid\"\><li class=\"mdui-list-item mdui-ripple\">
        <i class=\"mdui-list-item-icon mdui-icon material-icons\">edit</i>
        <div class=\"mdui-list-item-content\">编辑记事本</div>
        </li></a>";
        $delnote = "<a href=\"delnote.php?noteid=$noteid\"> <li class=\"mdui-list-item mdui-ripple\">
        <i class=\"mdui-list-item-icon mdui-icon material-icons\">delete</i>
        <div class=\"mdui-list-item-content\">删除记事本</div>
    </li></a>";
    } else {
        $editnote = null;
        $delnote = null;
    }
    echo <<<EOF
    <div class="mdui-drawer" id="main-drawer">
        <ul class="mdui-list">
            <div id="menu">
                <a href="index.php"><li class="mdui-list-item mdui-ripple"><i class="mdui-list-item-icon mdui-icon material-icons">event_note</i><div class="mdui-list-item-content">记事本</div></li></a>
                <a href="addnote.php">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">add</i>
                    <div class="mdui-list-item-content">新增记事本</div>
                </li>
                </a>
                $editnote
                $delnote
                <a href="lock.php">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">lock</i>
                    <div class="mdui-list-item-content">锁定</div>
                </li>
                </a>
            </div>
        </ul>
    </div>
EOF;
}
function mduiHead($title)
{
    $sitename = SITENAME;
    $path = PATH;
    echo <<<EOF
    <title>$sitename - $title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"
    integrity="sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw"
    crossorigin="anonymous"
    />
    <script
    src="https://cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"
    integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
    crossorigin="anonymous"
    ></script>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <link rel="icon" href="https://ivampiresp.com/wp-content/uploads/2020/02/cropped-illust_78879291_20200207_181713-32x32.jpg" sizes="32x32" />
    <link rel="icon" href="https://ivampiresp.com/wp-content/uploads/2020/02/cropped-illust_78879291_20200207_181713-192x192.jpg" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://ivampiresp.com/wp-content/uploads/2020/02/cropped-illust_78879291_20200207_181713-180x180.jpg" />
    <link rel="stylesheet" href="{$path}/editor.md/css/editormd.preview.min.css" />
    <link rel="stylesheet" href="{$path}/editor.md/css/editormd.min.css" />
    <style type="text/css">
    .link {
        color: blue;
        text-decoration:none
    }
    </style>
    <link rel="stylesheet" href="{$path}/style.css" type="text/css" />
    <script src="{$path}/editor.md/editormd.js"></script>
    <script src="{$path}/editor.md/lib/marked.min.js"></script>
    <script src="{$path}/editor.md/lib/prettify.min.js"></script>
EOF;
}
function mduiBody()
{
    echo '<body class="mdui-container mdui-drawer-body-left mdui-appbar-with-toolbar  mdui-theme-primary-indigo mdui-theme-accent-pink mdui-theme-layout-auto">';
}
