<?php
    session_start();
    unset($_SESSION["name"]);
    // unset($_SESSION["authority"]);
    session_destroy();
    echo '{"msg":"success"}';
?>