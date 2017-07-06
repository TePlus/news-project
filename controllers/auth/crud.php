<?php

class CRUD{

	private $db;
	private $response = array();

	function __construct($db)
	{
		$this->db = $db;
		$this->response['status'] = false;
	}

	public function login($strUsernanme, $strPassword){

		$error = false;

		// clean user inputs to prevent sql injections
		$username = trim($strUsernanme);
		$username = strip_tags($strUsernanme);
		$username = htmlspecialchars($strUsernanme);

		$pass = trim($strPassword);
		$pass = strip_tags($strPassword);
		$pass = htmlspecialchars($strPassword);

		if(empty($username)){
			$error = true;
			$usernameError = "Please enter your username.";
		}
			
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}

		// name validation 
		// if(empty($username)){
		// 	$error = true;
   		// 	$usernameError = "Please enter your full name.";
		// }else if (strlen($name) < 3) {
		// 	$error = true;
		// 	$nameError = "Name must have atleat 3 characters.";
		// } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		// 	$error = true;
		// 	$nameError = "Name must contain alphabets and space.";
		// }

		// password validation
		// if (empty($password)){
		// 	$error = true;
		// 	$passError = "Please enter password.";
		// } else if(strlen($password) < 6) {
		// 	$error = true;
		// 	$passError = "Password must have atleast 6 characters.";
		// }

		// username password example
		$username = "teplus";
		$pass = "1234";

		// password encrypt using SHA256();
		//$password = hash('sha256', $pass);

		// password encrypt using md5();
		$password = md5($pass);

		if(!$error){
			$sql = "select * from users where username = @username";
			$sql_param = array();
			$sql_param['username'] = $username;
			$sql_param['password'] = $password;
			$ds = null;
			$res = $this->db->query($ds,$sql,$sql_param,0,-1,"ASSOC");

			if($res != -1){

				$errTyp = "success";
    			$errMSG = "Successfully login";

				if($res == 1 && $ds[0]['password'] == $password){

					// SESSION
					$_SESSION['user'] = $row['userId'];

					$errTyp = "success";
					$errMSG = "Successfully Login";

					// $_SESSION['ses_userid'] = $ds[0]['user_id'];
					// $_SESSION['ses_username'] = $ds[0]['username'];    
					// $_SESSION['ses_status'] = $ds[0]['status'];  

					$response['data'] = array();
					$response['status'] = true;
					$response['data']['username'] = $ds[0]['username'];
					$response['data']['password'] = $ds[0]['password'];
					$response['data']['status'] = $ds[0]['status'];
					$response['data']['created_at'] = $ds[0]['created_at'];
					$response['data']['updated_at'] = $ds[0]['updated_at'];
				}else{
					$errTyp = "danger";
    				$errMSG = "Something went wrong, try again later..."; 
				}
			}else{
            	$errMSG = "Incorrect Credentials, Try again...";
			}
		}

		return $response;	
	}
}

function resposeError(String $err_code, String $err_txt){
		$response['error_code'] = $err_code;
		$response['error_text'] = $err_txt;
}

?>