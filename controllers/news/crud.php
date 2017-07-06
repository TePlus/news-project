<?php

class CRUD{

	private $db;
	private $response = array();

	function __construct($db)
	{
		$this->db = $db;
		$this->response['status'] = false;
	}

	public function index($page){
		
		$sql = "select * from news";
		// $sql = "select news.news_id, news.title, news.content, users.user_id from news join users on users.user_id=news.user_id limit 2";
		$sql_param = array();
		$ds = null;
		$res = $this->db->query($ds,$sql,$sql_param,0,-1,"ASSOC");
		if($res != -1){
			$response['status'] = true;
			$response['page'] = $page;
			$response['data'] = $ds;
		}else{
            $this->resposeError("001", "command error");
		}

		return $response;	
	}

	public function create($title, $content){

		if($title == ""){

		}

		if($content == ""){

		}

		$created_at = date('Y-m-d G:i:s');

		$sql_param['title'] = $title;
		$sql_param['content'] = $content;
		$sql_parem['created_at'] = $created_at;
		$news_id = "";
		$res = $this->db->executeInsert('news',$sql_param,$news_id);

		if($res != -1){
			$response['status'] = true;
			$response['data'] = array();
			$response['data']['news_id'] = $news_id;
			$response['data']['title'] = $title;
			$response['data']['content'] = $content;
			$response['data']['created_at'] = $created_at;
		}else{
			$this->resposeError("001", "command error");
		}

		return $response;
	}

	public function delete($id){

		$sql = "delete from news where news_id = @id";
		$sql_param = array();
		$sql_param['id'] = $id;
		$res = $this->db->execute($sql,$sql_param);

		if($res != -1){
			$response['status'] = true;
		}else{
            $this->resposeError("001", "command error");
		}
		return $response;	
	}

	public function update($id, $title, $content){

		if($title == ""){

		}

		if($content == ""){

		}

		$updated_at = date('Y-m-d G:i:s');

		$sql_param = array();
		$sql_param['news_id'] = $id;
		$sql_param['title'] = $title;
		$sql_param['content'] = $content;
		$sql_param['updated_at'] = $updated_at;
		$res = $this->db->executeUpdate('news', 1,$sql_param);

		if($res != -1){
				$response['status'] = true;
				$response['data'] = array();
				$response['data']['news_id'] = $id;
				$response['data']['title'] = $title;
				$response['data']['content'] = $content;
				$response['data']['updated_at'] = $updated_at;
		}else{
			// $response['error_code'] = $err_code;
			// $response['error_text'] = $err_txt;
		    $this->resposeError("001", "command error");
		}

		return $response;
	}

	public function show($id){
		$sql = "select * from news where news_id = @id";
		$sql_param = array();
		$sql_param['id'] = $id;
		$ds = null;
		$res = $this->db->query($ds,$sql,$sql_param,0,-1,"ASSOC");
		
		if($res != -1){
			$response['status'] = true;
			$response['data'] = array();
			$response['data']['news_id'] = $id;
			$response['data']['title'] = $ds[0]['title'];
			$response['data']['content'] = $ds[0]['content'];
			$response['data']['created_at'] = $ds[0]['created_at'];
			$response['data']['updated_at'] = $ds[0]['updated_at'];
			
		}else{
            $this->resposeError("001", "command error");
		}
		return $response;	
	}
}

function resposeError(String $err_code, String $err_txt){
		$response['error_code'] = $err_code;
		$response['error_text'] = $err_txt;
}

?>