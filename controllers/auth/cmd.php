<?php
require_once(ROOT_DIR . 'system/common.php');
// require_once('../../system/common.php');

include ("crud.php");
use OMCore\OMDb;
use OMCore\OM;

// var_dump(WEB_META_BASE_URL."auth");
//  if( isset($_SESSION['user'])!="" ){
//   header("Location: " + WEB_META_BASE_URL + "index.php");
//  }
$user = getUserData();
var_dump($user);
exit();

$cmd = isset($_POST['cmd']) ? $_POST['cmd'] : "";

switch ($cmd) {
    case "login":
    
        $DB = OMDb::singleton();
    	$username = isset($_POST['username']) ? trim($_POST['username']) : "";
		$password = isset($_POST['password']) ? trim($_POST['password']) : "";

        $obj = new CRUD($DB);
		echo json_encode($obj->login($username, $password));

        break;
    default:
        return "";
}
?>