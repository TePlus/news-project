<?php

class CRUD
{

    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function login($strUsernanme, $strPassword, $strRemember)
    {

        $response['status'] = false;

        $error = false;

        // clean user inputs to prevent sql injections
        $username = trim($strUsernanme);
        $username = strip_tags($strUsernanme);
        $username = htmlspecialchars($strUsernanme);

        $pass = trim($strPassword);
        $pass = strip_tags($strPassword);
        $pass = htmlspecialchars($strPassword);

        if (empty($username)) {
            $error = true;
            $usernameError = "Please enter your username.";
        }

        if (empty($pass)) {
            $error = true;
            $passError = "Please enter your password.";
        }

        // username password example
        // $username = "teplus";
        // $pass = "1234";

        // password encrypt using SHA256();
        //$password = hash('sha256', $pass);

        // password encrypt using md5();
        $password = md5($pass);

        if (!$error) {
            $sql = "select * from users where username = @username";
            $sql_param = array();
            $sql_param['username'] = $username;
            $sql_param['password'] = $password;
            $ds = null;
            $res = $this->db->query($ds, $sql, $sql_param, 0, -1, "ASSOC");

            $response['data'] = array();

            if ($res != -1) {

                if ($res == 1 && $ds[0]['password'] == $password) {

                    //ready to login
                    $_SESSION['user_id'] = $ds[0]['user_id'];
                    $_SESSION['username'] = $ds[0]['username'];
                    $_SESSION['user_status'] = $ds[0]['status'];

                    //check to see if remember, ie if cookie
                    if (isset($strRemember)) {
                        //set the cookies for 1 day, ie, 1*24*60*60 secs
                        //change it to something like 30*24*60*60 to remember user for 30 days
                        setcookie('username', $username, time() + 1 * 24 * 60 * 60);
                        setcookie('password', $password, time() + 1 * 24 * 60 * 60);

                        // response data
                        $response['status'] = true;

                        $response['data']['username'] = $ds[0]['username'];
                        $response['data']['password'] = $ds[0]['password'];
                        $response['data']['status'] = $ds[0]['status'];
                        $response['data']['created_at'] = $ds[0]['created_at'];
                        $response['data']['updated_at'] = $ds[0]['updated_at'];

                        $response['data']['resMsg'] = "successfully";

                    } else {
                        //destroy any previously set cookie
                        setcookie('username', '', time() - 1 * 24 * 60 * 60);
                        setcookie('password', '', time() - 1 * 24 * 60 * 60);
                    }

                } else {
                    $response['data']['resMsg'] = "Incorrect Credentials, Try again...";
                }
            }
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