<?php

class CRUD
{

    private $db;
    private $response = array();

    function __construct($db)
    {
        $this->db = $db;
        $this->response['status'] = false;
    }

    public function index($page)
    {
        // $sql = "select * from news";
        $sql = "select news.news_id, news.title, news.content, news.created_at, users.user_id, users.username, users.status from news join users on users.user_id=news.user_id order by created_at desc";

        $sql_param = array();
        $ds = null;
        $res = $this->db->query($ds, $sql, $sql_param, 0, -1, "ASSOC");
        if ($res != -1) {
            $response['status'] = true;
            $response['page'] = $page;
            $response['data'] = $ds;
        } else {
            $this->resposeError("001", "command error");
        }

        return $response;
    }

    public function create($title, $content)
    {

        if ($title == "") {

        }

        if ($content == "") {

        }

        $created_at = date('Y-m-d G:i:s');

        $user_id = $_SESSION['user_id'];

        $sql_param = array();
        $sql_param['title'] = $title;
        $sql_param['content'] = $content;
        $sql_param['created_at'] = $created_at;
        $sql_param['user_id'] = $user_id;


        $news_id = "";
        $res = $this->db->executeInsert('news', $sql_param, $news_id);


        if ($res != -1) {
            $response['status'] = true;
            $response['data'] = array();
            $response['data']['news_id'] = $news_id;
            $response['data']['title'] = $title;
            $response['data']['content'] = $content;
            $response['data']['created_at'] = $created_at;
            $response['data']['user_id'] = $user_id;
        } else {
            $this->resposeError("001", "command error");
        }

        return $response;
    }

    public function delete($id)
    {

        $sql = "delete from news where news_id = @id";
        $sql_param = array();
        $sql_param['id'] = $id;
        $res = $this->db->execute($sql, $sql_param);

        if ($res != -1) {
            $response['status'] = true;
        } else {
            $this->resposeError("001", "command error");
        }
        return $response;
    }

    public function update($id, $title, $content)
    {

        if ($title == "") {

        }

        if ($content == "") {

        }

        $user_id = $_SESSION['user_id'];
        $updated_at = date('Y-m-d G:i:s');

        $sql_param = array();
        $sql_param['news_id'] = $id;
        $sql_param['title'] = $title;
        $sql_param['content'] = $content;
        $sql_param['updated_at'] = $updated_at;
        $response['data']['user_id'] = $user_id;
        $res = $this->db->executeUpdate('news', 1, $sql_param);

        if ($res != -1) {
            $response['status'] = true;
            $response['data'] = array();
            $response['data']['news_id'] = $id;
            $response['data']['title'] = $title;
            $response['data']['content'] = $content;
            $response['data']['updated_at'] = $updated_at;
        } else {
            // $response['error_code'] = $err_code;
            // $response['error_text'] = $err_txt;
            $this->resposeError("001", "command error");
        }

        return $response;
    }

    public function show($id)
    {
        $sql = "select * from news where news_id = @id";
        $sql_param = array();
        $sql_param['id'] = $id;
        $ds = null;
        $res = $this->db->query($ds, $sql, $sql_param, 0, -1, "ASSOC");

        if ($res != -1) {
            $response['status'] = true;
            $response['data'] = array();
            $response['data']['news_id'] = $id;
            $response['data']['title'] = $ds[0]['title'];
            $response['data']['content'] = $ds[0]['content'];
            $response['data']['created_at'] = $ds[0]['created_at'];
            $response['data']['updated_at'] = $ds[0]['updated_at'];

        } else {
            $this->resposeError("001", "command error");
        }
        return $response;
    }
}

function resposeError($err_code, $err_txt)
{
    $response['error_code'] = $err_code;
    $response['error_text'] = $err_txt;
}

?>