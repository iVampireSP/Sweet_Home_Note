function sharenote(noteid) {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        // 主流浏览器
        xmlhttp = new XMLHttpRequest();
    } else {
        // IE6等
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            mdui.alert(xmlhttp.responseText);
        }
    }
    xmlhttp.open("POST", "note.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(`noteid=${noteid}&action=share`);
}