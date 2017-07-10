<?php


if(!isset($_SESSION["user_id"])){
    header("Location: " . WEB_META_BASE_URL . "index");
}else if(isset($_SESSION["user_id"])!=""){
    header("Location: " . WEB_META_BASE_URL . "news");
}


if(isset($_GET['logout'])){
    unset($_SESSION['user_id']);
    session_unset();
    session_destroy();
    setcookie('username', '', time() - 1*24*60*60);
    setcookie('password', '', time() - 1*24*60*60);
    header("Location: " . WEB_META_BASE_URL . "index");
}

?>