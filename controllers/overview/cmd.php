<?php
require_once(ROOT_DIR . 'system/common.php');
use OMCore\OMDb;
use OMCore\OM;
$DB = OMDb::singleton();

$url = WEB_META_BASE_URL."info.php";
// $param = array();
// $param['test'] = "1235";
// $response = OM::cURL("POST",$url,$param);
// var_dump($response);
// exit();

$cmd = isset($_POST['cmd']) ? $_POST['cmd'] : "";
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : "";
$response = array();
$response['status'] = false;
if($cmd == "add"){
	$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : "";
	if($product_name == ""){

	}
	$sql_param['product_name'] = $product_name;
	$product_id = "";
	$res = $DB->executeInsert('product',$sql_param,$product_id);
	if($res != -1){
		$response['status'] = true;
		$response['data'] = array();
		$response['data']['product_id'] = $product_id;
	}else{
		$response['error_code'] = "001";
		$response['error_text'] = "not insert";
	}
}
echo json_encode($response);
?>