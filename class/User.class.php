<?php
class User {
    private $password;
    public $title;
    public $content;
    public $db_con;
    public $noteid;
    public $share;
    // 方法：解锁
    public function userLogin($password, $configpwd) {
        $this->password = md5($password);
        if ($this->password == PASSWORD) {
            header('Location: index.php');
            $_SESSION['user'] = 1;
        }
    }

    // 方法：登出
    public function userLogout() {
        session_destroy();
        return '*';
    }

    // 方法：列出所有记事本
    public function listNote() {
        // 为了数据库和浏览器性能，需要截取从数据库中的字符串。
        $sql = "SELECT `id`, `title`, `add_time`, LEFT(`content`, 100), `share` FROM `notes` ORDER BY `notes`.`add_time` DESC";
        $result = $this->db_con->query($sql);
        while($row = mysqli_fetch_array($result)) {
            $noteid = $row['id'];
            $title = htmlspecialchars($row['title']);
            $content = htmlspecialchars($row['LEFT(`content`, 100)']);
            $add_time = $row['add_time'];
            if (!$row['share'] == NULL) {
                $share = '<span style="color:red">SHARE</span>';
            }else {
                $share = NULL;
            }
            echo <<<START
            <a href="note.php?noteid=$noteid">
                <li class="mdui-list-item mdui-ripple">
                    <div class="mdui-list-item-content">
                        <div class="mdui-list-item-title mdui-list-item-one-line texto"><span class="mdui-text-color-theme">$title</span><span style="color: gray;position: absolute; right: 15px">$share $add_time</span></div>
                        <div class="mdui-list-item-text mdui-list-item-two-line">$content...</div>
                    </div>
                </li>
            </a>
START;
        }
        $this->db_con->close();
    }

    // 方法：获取记事本标题
    public function getTitle() {
        $this->noteid = mysqli_real_escape_string($this->db_con, $this->noteid);
        $sql = "SELECT `title` FROM `notes` WHERE `id` = $this->noteid";
        $result = $this->db_con->query($sql);
        while($rows = mysqli_fetch_array($result)) {
            return $this->title = $rows['title'];
        }
        $this->db_con->close();
    }

    // 方法：获取记事本内容
    public function viewNote() {
        $this->noteid = mysqli_real_escape_string($this->db_con, $this->noteid);
        $sql = "SELECT `content` FROM `notes` WHERE `id` = $this->noteid";
        $result = $this->db_con->query($sql);
        while($rows = mysqli_fetch_array($result)) {
            return $this->content = $rows['content'];
        }
        $this->db_con->close();
    }

    // 方法：添加记事本
    public function addNote($title, $content) {
        $this->title = mysqli_real_escape_string($this->db_con, $title);
        $this->content = mysqli_real_escape_string($this->db_con, $content);
        $datetime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `notes` (`id`, `title`, `content`, `add_time`) VALUES (NULL, '$this->title', '$this->content', '$datetime')";
        $this->db_con->query($sql);
        $this->db_con->close();
    }

    // 方法：更改记事本内容
    public function editNote($title, $content) {
        $this->title = mysqli_real_escape_string($this->db_con, $title);
        $this->content = mysqli_real_escape_string($this->db_con, $content);
        $sql = "UPDATE `notes` SET `title` = '$this->title' WHERE `id` = $this->noteid";
        $this->db_con->query($sql);
        $sql = "UPDATE `notes` SET `content` = '$this->content' WHERE `id` = $this->noteid";
        $this->db_con->query($sql);
        $this->db_con->close();
    }

    // 方法：删除记事本
    public function delNote() {
        $sql = "DELETE FROM `notes` WHERE `notes`.`id` = $this->noteid";
        $this->db_con->query($sql);
        $this->db_con->close();
    }
    
    // 方法：分享记事本相关操作
    public function shareNote() {
        $this->noteid = mysqli_real_escape_string($this->db_con, $this->noteid);
        // 判断数据库中内容，如果已经分享则取消分享，为分享则分享。
        $sql = "SELECT `share` FROM `notes` WHERE `id` = $this->noteid";
        while($row = mysqli_fetch_array($this->db_con->query($sql))) {
            if ($row['share'] == NULL) {
                // 如果为空，则共享
                $sql = "UPDATE `notes` SET `share` = 1 WHERE `notes`.`id` = $this->noteid";
                $this->db_con->query($sql);
                return '已共享，将此页面的URL发送给其他人即可。';
                echo $row['share'];
            }else{
                // 取消共享
                $sql = "UPDATE `notes` SET `share` = NULL WHERE `notes`.`id` = $this->noteid";
                $this->db_con->query($sql);
                return '已取消共享，其他人无法查看该页面。';
                echo $row['share'];
            }
        }
        $this->db_con->close();
    }

    // 方法：获取记事本分享状态
    public function getShare() {
        $this->noteid = mysqli_real_escape_string($this->db_con, $this->noteid);
        $sql = "SELECT `share` FROM `notes` WHERE `id` = $this->noteid";
        $result = $this->db_con->query($sql);
        while($rows = mysqli_fetch_array($result)) {
            return $this->share = $rows['share'];
        }
        $this->db_con->close();
    }
}