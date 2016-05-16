<?php
    require_once('./connect.php');
    $sql = "select id,pid from pics where visible = 1 order by id desc";
    $query = mysql_query($sql);
    if ($query && mysql_num_rows($query)) {
        while ($row = mysql_fetch_assoc($query)) {
            $data[] = $row;
        }
        $json["status"] = 1;
        $json["data"] = $data;
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    } else {
        echo '{"status":0,"msg":"未查询到数据"}';
    }
?>