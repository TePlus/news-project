<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('system/common.php');


$_controllerPath = ROOT_DIR ."controllers/". OMCore\OMRoute::path() . '.php';

if(is_file($_controllerPath)) {

	include TMPL_DIR .'core/master.tpl';

}else{
	http_response_code(404);
	OMCore\OMRoute::notFound();
	// $smarty  = new OMPage();
	// $smarty->display('404');
}

?>