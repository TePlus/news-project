<?php
// require_once(ROOT_DIR . 'system/common.php');
require_once('../../system/common.php');
include("crud.php");

use OMCore\OMDb;
use OMCore\OM;

$DB = OMDb::singleton();

$cmd = isset($_POST['cmd']) ? $_POST['cmd'] : "";

switch ($cmd) {
    case "login":

        $DB = OMDb::singleton();
        $username = isset($_POST['username']) ? trim($_POST['username']) : "";
        $password = isset($_POST['password']) ? trim($_POST['password']) : "";
        $remember = isset($_POST['remember']) ? $_POST['remember'] : "";

        $obj = new CRUD($DB);
        echo json_encode($obj->login($username, $password, $remember));
        die;

        break;
    default:
        return "";
}
?>