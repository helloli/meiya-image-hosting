<?php
    require_once('connect.php');
    $postData = json_decode(file_get_contents('php://input'),true);
    $url = $postData['url'];
    $visible = isset($postData['visible']) ? $postData['visible'] : 1;
    $sql = "insert into pics(url,visible) values('$url','$visible')";
    if(mysql_query($sql)){
        echo '{"msg":"success"}';
    } else {
        echo '{"msg":"wrong"}';
    }
?>