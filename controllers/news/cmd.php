<?php
// require_once('../../system/common.php');

// if(!define('DS')){
//     define('DS', DIRECTORY_SEPARATOR);
// }

// if (!defined('ROOT_DIR')) {
//     $__file__ = explode("system".DS, __FILE__);
//     define('ROOT_DIR', $__file__[0] );
// }

// var_dump(ROOT_DIR);
// exit();

// require_once(ROOT_DIR . '/system/common.php');
// require_once(ROOT_DIR . '/controllers/news/crud.php');

require_once('../../system/common.php');
include("crud.php");

use OMCore\OMDb;
use OMCore\OM;

$DB = OMDb::singleton();

$url = WEB_META_BASE_URL . "info.php";

$cmd = isset($_POST['cmd']) ? $_POST['cmd'] : "";
$news_id = isset($_POST['news_id']) ? $_POST['news_id'] : "";
$page = isset($_POST['page']) ? $_POST['page'] : "";

switch ($cmd) {
    case "index":

        $obj = new CRUD($DB);
        echo json_encode($obj->index($page));
        break;

    case "show":

        $obj = new CRUD($DB);
        echo json_encode($obj->show($news_id));
        break;

    case "create":

        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $content = isset($_POST['content']) ? $_POST['content'] : "";

        $obj = new CRUD($DB);
        echo json_encode($obj->create($title, $content));

        break;

    case "update":

        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $content = isset($_POST['content']) ? $_POST['content'] : "";

        $obj = new CRUD($DB);
        echo json_encode($obj->update($news_id, $title, $content));
        break;

    case "delete":

        $obj = new CRUD($DB);
        echo json_encode($obj->delete($news_id));
        break;
    default:
        return "";
}
?>