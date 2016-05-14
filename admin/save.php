<?php
    require_once('./connect.php');
    $postData = json_decode(file_get_contents('php://input'),true);
    $pid = $postData['pid'];
    $visible = isset($postData['visible']) ? $postData['visible'] : 1;
    $addTime = time();
    $sql = "insert into pics(pid,visible,addTime) values('$pid','$visible','$addTime')";
    if (mysql_query($sql)) {
        $querySql = "select id from pics where pid='$pid'";
        $query = mysql_query($querySql);
        if ($query && mysql_num_rows($query)) {
            $data[] = mysql_fetch_assoc($query);
            $json["status"] = 1;
            $json["data"] = $data;
            echo json_encode($json, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{"status":"-1","msg":"查询id失败"}';
        }
    } else {
        echo '{"status":"0","msg":"插入数据库失败"}';
    }
?>