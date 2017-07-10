<?php
use OMCore\OMDb;
use OMCore\OM;
$DB = OMDb::singleton();


	// $id = 3;
	// $sql = "select * from news where news_id = @id";
	// $sql_param = array();
	// $sql_param['id'] = $id;
	// $ds = null;
	// $res = $DB->query($ds,$sql,$sql_param,0,-1,"ASSOC");


	// $user = getUserData();
	// var_dump($user);
	// exit();

	$obj = new CRUD($DB);
	$obj->index();

	class CRUD{

		protected $db;

		function __construct($db)
		{
			$this->db = $db;
		}

		function a(){
			echo "a";
		}

		function b(){
			echo $this->a();
		}

		public function delete($news_id){

		$sql = "delete from news where news_id = @id";
		$sql_param = array();
		$sql_param['id'] = $news_id;
		$res = $this->db->execute($sql,$sql_param);

		var_dump($res);
		exit();

		if($res != -1){
			$response['status'] = true;
		}else{
			resposeError("001", "command error");
		}
	}

	function index(){
			$id = 1;
			$sql = "select * from news";
			$sql_param = array();
			$sql_param['id'] = $id;
			$ds = null;
			$res = $this->db->query($ds,$sql,$sql_param,0,-1,"ASSOC");

			var_dump($ds);
			exit();
			}
	}

?>

// $PAGE_VAR["css"][] = "overview";

// $PAGE_VAR["js"][] = "overview";
// $id = 1;
// $sql = "select * from test";
// $sql_param = array();
// $sql_param['id'] = $id;
// $ds = null;
// $res = $DB->query($ds,$sql,$sql_param,0,-1,"ASSOC");

// $id = 100;
// $id = "";
// $sql_param = array();
// // $sql_param['id'] = null;
// $sql_param['news_name'] = "Hello";

// $res = $DB->executeInsert('test', $sql_param);
// var_dump($res);
// exit();
// // $DB->executeInsert('test', null, $sql_param);

// // $id = 1;
// $sql = "select * from test";
// $sql_param = array();
// $sql_param['id'] = $id;
// $ds = null;
// $res = $DB->query($ds,$sql,$sql_param,0,-1,"ASSOC");
// var_dump($ds);

// $id = '';
// $sql_param = array();
// $sql_param['product_name'] = "example";
// $DB->executeInsert('product', $sql_param,$id);
// var_dump($id);

// $id = '56';
// $sql_param = array();
// $sql_param['product_id'] = $id;
// $sql_param['product_name'] = "example11111";
// $res = $DB->executeUpdate('product', 1,$sql_param);

// $sql = "delete from product where product_id = @id";
// $sql_param = array();
// $sql_param['id'] = "57";
// $r = $DB->execute($sql,$sql_param);
// var_dump($r);
// $DB->executeUpdate('product, $KeyCount, $ParamList = null);

<div id="test" style="color:red;">XXXXXX</div>