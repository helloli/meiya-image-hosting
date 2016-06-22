<?php
    require_once('connect.php');
    session_start();
    unset($_SESSION['name']);
    // unset($_SESSION['authority']);
    session_destroy();
    // $user = json_decode(file_get_contents('php://input'),true);
    // $name = $user['name'];
    // $pw = $user['pw'];
    $name = $_POST['name'];
    $pw = $_POST['pw'];
    $sql = "select uid,name from user where name ='$name' and password = '$pw'";
    $query = mysql_query($sql);
    $queryData = mysql_fetch_assoc($query);
    // echo json_encode($name);
    if($query && mysql_num_rows($query)){
        session_start();
        $_SESSION["name"] = $name;
        // $_SESSION["authority"] = $queryData['authority'];
        echo json_encode($queryData,JSON_UNESCAPED_UNICODE);
    }else {
        echo '{"msg":"wrong"}';
    }
?>